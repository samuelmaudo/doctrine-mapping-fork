<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;
use ReflectionClass;

/**
 * @psalm-immutable
 */
final class OneToOne extends AbstractAssociation
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|null $mappedBy
     * @param non-empty-string|null $inversedBy
     * @param list<Cascade> $cascade
     *
     * @internal
     */
    public function __construct(
        protected string $property,
        protected ReflectionClass $targetEntity,
        protected ?string $mappedBy,
        protected ?string $inversedBy,
        protected array $cascade,
        protected Fetch $fetch,
        protected bool $orphanRemoval,
        protected ?JoinColumns $joinColumns,
    ) {}

    /**
     * @param non-empty-string $property
     * @param class-string|null $targetEntity
     * @param non-empty-string|null $mappedBy
     * @param non-empty-string|null $inversedBy
     * @param list<Cascade>|null $cascade
     * @param Fetch|'LAZY'|'EAGER'|'EXTRA_LAZY' $fetch
     * 
     * @throws DoctrineMappingException
     */
    public static function of(
        string $property,
        ?string $targetEntity = null,
        ?string $mappedBy = null,
        ?string $inversedBy = null,
        ?array $cascade = null,
        Fetch|string $fetch = 'LAZY',
        bool $orphanRemoval = false,
    ): self|IncompleteOneToOne {
        self::validateProperty($property);
        $targetEntity = ClassResolver::resolveNullable($targetEntity);
        self::validateMappedBy($property, $targetEntity, $mappedBy);
        self::validateInversedBy($property, $targetEntity, $inversedBy);
        $cascade = self::sanitizeCascade($property, $cascade);
        $fetch = self::sanitizeFetch($property, $fetch);

        if (null === $targetEntity) {
            return new IncompleteOneToOne($property, $mappedBy, $inversedBy, $cascade, $fetch, $orphanRemoval, null);
        }

        return new self($property, $targetEntity, $mappedBy, $inversedBy, $cascade, $fetch, $orphanRemoval, null);
    }

    /**
     * @param ?non-empty-string $name Name of the column that holds the foreign key for this relation.
     * @param non-empty-string $referencedColumnName Name of the primary key that is used for joining of this relation.
     * @param ?non-empty-string $columnDefinition SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param non-empty-array<non-empty-string,mixed>|null $options Platform specific options.
     *
     * @throws DoctrineMappingException
     */
    public function withJoinColumn(
        string|null $name = null,
        string $referencedColumnName = 'id',
        bool $unique = false,
        bool $nullable = true,
        mixed $onDelete = null,
        string|null $columnDefinition = null,
        array $options = [],
    ): self {
        return new self(
            $this->property,
            $this->targetEntity,
            $this->mappedBy,
            $this->inversedBy,
            $this->cascade,
            $this->fetch,
            $this->orphanRemoval,
            JoinColumns::of($this, JoinColumn::of(
                $name,
                $referencedColumnName,
                $unique,
                $nullable,
                $onDelete,
                $columnDefinition,
                $options,
            )),
        );
    }

    /**
     * @param non-empty-list<JoinColumn> $joinColumns
     *
     * @throws DoctrineMappingException
     */
    public function withJoinColumns(
        JoinColumn ...$joinColumns,
    ): self {
        return new self(
            $this->property,
            $this->targetEntity,
            $this->mappedBy,
            $this->inversedBy,
            $this->cascade,
            $this->fetch,
            $this->orphanRemoval,
            JoinColumns::of($this, ...$joinColumns),
        );
    }

    /**
     * @return non-empty-string|null
     */
    public function mappedBy(): ?string
    {
        return $this->mappedBy;
    }

    /**
     * @return non-empty-string|null
     */
    public function inversedBy(): ?string
    {
        return $this->inversedBy;
    }

    public function orphanRemoval(): bool
    {
        return $this->orphanRemoval;
    }

    public function joinColumns(): ?JoinColumns
    {
        return $this->joinColumns;
    }
}
