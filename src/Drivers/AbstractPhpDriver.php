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
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedMappedSuperclass;
use Hereldar\DoctrineMapping\Internals\Resolvers\EmbeddableResolver;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbedded;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEntity;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedField;
use Hereldar\DoctrineMapping\Internals\Resolvers\MappedSuperclassResolver;
use Hereldar\DoctrineMapping\MappedSuperclass;

abstract class AbstractPhpDriver implements MappingDriver
{
    protected FileLocator $locator;

    /**
     * @var array<string, ResolvedEntity|ResolvedMappedSuperclass|ResolvedEmbeddable>
     * @psalm-var array<class-string, ResolvedEntity|ResolvedMappedSuperclass|ResolvedEmbeddable>
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

        /** @var ResolvedEntity|ResolvedMappedSuperclass|ResolvedEmbeddable $entity */
        $entity = $this->classCache[$className];

        if ($entity instanceof ResolvedEntity) {
            $metadata->setPrimaryTable([
                'name' => $entity->table,
                'schema' => null,
            ]);
        } elseif ($entity instanceof ResolvedMappedSuperclass) {
            $metadata->isMappedSuperclass = true;
        } elseif ($entity instanceof ResolvedEmbeddable) {
            $metadata->isEmbeddedClass = true;
        }

        foreach ($entity->fields as $field) {
            if ($field instanceof ResolvedField) {
                $metadata->mapField([
                    'fieldName' => $field->property,
                    'columnName' => $field->column,
                    'type' => $field->type,
                    'id' => $field->primaryKey,
                    'unique' => $field->unique,
                    'nullable' => $field->nullable,
                    'notInsertable' => ($field->insertable === false),
                    'notUpdatable' => ($field->updatable === false),
                    'length' => $field->length,
                    'precision' => $field->precision,
                    'scale' => $field->scale,
                    'options' => [
                        'unsigned' => $field->unsigned,
                        'fixed' => $field->fixed,
                    ],
                ]);
            } elseif ($field instanceof ResolvedEmbedded) {
                $metadata->mapEmbedded([
                    'fieldName' => $field->property,
                    'class' => $field->class,
                    'columnPrefix' => $field->columnPrefix,
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
        } elseif ($class instanceof MappedSuperclass) {
            [$superclass, $embeddables] = MappedSuperclassResolver::resolve($class);
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

        if (isset($superclass)) {
            $result[$superclass->class] = $superclass;
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
