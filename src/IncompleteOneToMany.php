<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;

/**
 * @psalm-immutable
 */
final class IncompleteOneToMany extends AbstractIncompleteAssociation
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|null $mappedBy
     * @param list<Cascade> $cascade
     * @param non-empty-string|null $indexBy
     *
     * @internal
     */
    public function __construct(
        protected string $property,
        protected ?string $mappedBy,
        protected array $cascade,
        protected Fetch $fetch,
        protected bool $orphanRemoval,
        protected ?string $indexBy,
    ) {}

    /**
     * @param class-string $class
     *
     * @throws DoctrineMappingException
     */
    public function withTargetEntity(string $class): OneToMany
    {
        return new OneToMany(
            $this->property,
            ClassResolver::resolve($class),
            $this->mappedBy,
            $this->cascade,
            $this->fetch,
            $this->orphanRemoval,
            $this->indexBy,
        );
    }

    /**
     * @return non-empty-string|null
     */
    public function mappedBy(): ?string
    {
        return $this->mappedBy;
    }

    public function orphanRemoval(): bool
    {
        return $this->orphanRemoval;
    }

    /**
     * @return non-empty-string|null
     */
    public function indexBy(): ?string
    {
        return $this->indexBy;
    }
}
