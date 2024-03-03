<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Drivers;

use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\FileLocator;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEntity;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedMappedSuperclass;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\MetadataFactory;
use Hereldar\DoctrineMapping\Internals\Resolvers\EmbeddableResolver;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
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
     * @throws DoctrineMappingException
     */
    public function loadMetadataForClass($className, ClassMetadata $metadata): void
    {
        if (!isset($this->classCache[$className])) {
            try {
                $this->loadMappingFile($className);
            } catch (\Throwable $exception) {
                $fileName = $this->locator->findMappingFile($className);
                throw MappingException::invalidFile($fileName, $exception);
            }
        }

        $entity = $this->classCache[$className];

        try {
            MetadataFactory::fillMetadataObject($entity, $metadata);
        } catch (\Throwable $exception) {
            throw MappingException::invalidMetadata($className, $exception);
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
    public function isTransient($className): bool
    {
        if (isset($this->classCache[$className])) {
            return false;
        }

        return !$this->locator->fileExists($className);
    }

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
            throw MappingException::metadataNotFound($className);
        }

        foreach ($result as $clsName => $cls) {
            $this->classCache[$clsName] = $cls;
        }
    }
}
