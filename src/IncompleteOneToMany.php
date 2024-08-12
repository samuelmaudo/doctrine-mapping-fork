<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;

final class IncompleteOneToMany extends IncompleteAssociation
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
        protected readonly string $property,
        protected readonly ?string $mappedBy,
        protected readonly array $cascade,
        protected readonly Fetch $fetch,
        protected readonly bool $orphanRemoval,
        protected readonly ?string $indexBy,
        protected readonly ?OrderBy $orderBy,
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
            $this->orderBy,
        );
    }

    /**
     * @param non-empty-array<non-empty-string,'ASC'|'DESC'> $value
     *
     * @throws DoctrineMappingException
     */
    public function withOrderBy(
        array $value,
    ): self {
        return new self(
            $this->property,
            $this->mappedBy,
            $this->cascade,
            $this->fetch,
            $this->orphanRemoval,
            $this->indexBy,
            OrderBy::of($this, $value),
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

    public function orderBy(): ?OrderBy
    {
        return $this->orderBy;
    }
}
