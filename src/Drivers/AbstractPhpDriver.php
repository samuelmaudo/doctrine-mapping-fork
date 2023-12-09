<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Drivers;

use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Mapping\MappingException as OrmMappingException;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\FileLocator;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use Doctrine\Persistence\Mapping\MappingException;
use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\EmbeddableResolver;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\EntityResolver;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbedded;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEntity;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedField;

abstract class AbstractPhpDriver implements MappingDriver
{
    protected FileLocator $locator;

    /**
     * @var array<string, ResolvedEntity|ResolvedEmbeddable>
     * @psalm-var array<class-string, ResolvedEntity|ResolvedEmbeddable>
     */
    protected array $classCache = [];

    /**
     * Retrieves the locator used to discover mapping files by className.
     */
    public function getLocator(): FileLocator
    {
        return $this->locator;
    }

    /**
     * Sets the locator used to discover mapping files by className.
     */
    public function setLocator(FileLocator $locator): void
    {
        $this->locator = $locator;
    }

    /**
     * {@inheritDoc}
     *
     * @throws MappingException
     * @throws OrmMappingException
     */
    public function loadMetadataForClass(string $className, ClassMetadata $metadata): void
    {
        assert($metadata instanceof ClassMetadataInfo);

        if (!isset($this->classCache[$className])) {
            $this->loadMappingFile($className);
        }

        /** @var ResolvedEntity|ResolvedEmbeddable $class */
        $class = $this->classCache[$className];

        if ($class instanceof ResolvedEntity) {
            $metadata->setPrimaryTable([
                'name' => $class->table,
                'schema' => null,
            ]);
        } elseif ($class instanceof ResolvedEmbeddable) {
            $metadata->isEmbeddedClass = true;
        }

        foreach ($class->properties as $property) {
            if ($property instanceof ResolvedField) {
                $metadata->mapField([
                    'fieldName' => $property->property,
                    'columnName' => $property->column,
                    'type' => $property->type,
                    'id' => $property->primaryKey,
                    'unique' => $property->unique,
                    'nullable' => $property->nullable,
                    'notInsertable' => ($property->insertable === false),
                    'notUpdatable' => ($property->updatable === false),
                    'length' => $property->length,
                    'precision' => $property->precision,
                    'scale' => $property->scale,
                    'options' => [
                        'unsigned' => $property->unsigned,
                        'fixed' => $property->fixed,
                    ],
                ]);
            } elseif ($property instanceof ResolvedEmbedded) {
                $metadata->mapEmbedded([
                    'fieldName' => $property->property,
                    'class' => $property->class,
                    'columnPrefix' => $property->columnPrefix,
                ]);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAllClassNames(): ?array
    {
        if ($this->classCache === []) {
            return $this->locator->getAllClassNames('');
        }

        return array_values(array_unique(array_merge(
            array_keys($this->classCache),
            $this->locator->getAllClassNames('')
        )));
    }

    /**
     * {@inheritDoc}
     */
    public function isTransient(string $className): bool
    {
        if (isset($this->classCache[$className])) {
            return false;
        }

        return !$this->locator->fileExists($className);
    }

    /**
     * Loads a mapping file with the given name and returns a map
     * from class/entity names to their corresponding elements.
     *
     * @psalm-param class-string $className
     *
     * @throws MappingException
     */
    protected function loadMappingFile(string $className): void
    {
        $fileName = $this->locator->findMappingFile($className);

        $class = include $fileName;

        if ($class instanceof Entity) {
            [$entity, $embeddables] = EntityResolver::resolve($class);
        } elseif ($class instanceof Embeddable) {
            $embeddables = EmbeddableResolver::resolve($class);
        }

        $result = [];

        if (isset($entity)) {
            $result[$entity->class] = $entity;
        }

        if (isset($embeddables)) {
            foreach ($embeddables as $embeddable) {
                $result[$embeddable->class] = $embeddable;
            }
        }

        if (!isset($result[$className])) {
            $fileName = str_replace('\\', '.', $className).$this->locator->getFileExtension();
            throw MappingException::invalidMappingFile($className, $fileName);
        }

        foreach ($result as $clsName => $cls) {
            $this->classCache[$clsName] = $cls;
        }
    }
}
