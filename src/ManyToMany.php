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
final class ManyToMany extends AbstractAssociation
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|null $mappedBy
     * @param non-empty-string|null $inversedBy
     * @param list<Cascade> $cascade
     * @param non-empty-string|null $indexBy
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
        protected ?string $indexBy,
        protected ?JoinTable $joinTable,
        protected ?JoinColumns $joinColumns,
        protected ?JoinColumns $inverseJoinColumns,
        protected ?OrderBy $orderBy,
    ) {}

    /**
     * @param non-empty-string $property
     * @param class-string $targetEntity
     * @param non-empty-string|null $mappedBy
     * @param non-empty-string|null $inversedBy
     * @param list<Cascade>|null $cascade
     * @param Fetch|'LAZY'|'EAGER'|'EXTRA_LAZY' $fetch
     * @param non-empty-string|null $indexBy
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $property,
        string $targetEntity,
        ?string $mappedBy = null,
        ?string $inversedBy = null,
        ?array $cascade = null,
        Fetch|string $fetch = 'LAZY',
        bool $orphanRemoval = false,
        ?string $indexBy = null,
    ): self {
        self::validateProperty($property);
        $targetEntity = ClassResolver::resolve($targetEntity);
        self::validateMappedBy($property, $targetEntity, $mappedBy);
        self::validateInversedBy($property, $targetEntity, $inversedBy);
        $cascade = self::sanitizeCascade($property, $cascade);
        $fetch = self::sanitizeFetch($property, $fetch);
        self::validateIndexBy($property, $targetEntity, $indexBy);

        return new self(
            $property,
            $targetEntity,
            $mappedBy,
            $inversedBy,
            $cascade,
            $fetch,
            $orphanRemoval,
            $indexBy,
            null,
            null,
            null,
            null,
        );
    }

    /**
     * @param non-empty-string $name Name of the join table.
     *
     * @throws DoctrineMappingException
     */
    public function withJoinTable(string $name): self
    {
        return new self(
            $this->property,
            $this->targetEntity,
            $this->mappedBy,
            $this->inversedBy,
            $this->cascade,
            $this->fetch,
            $this->orphanRemoval,
            $this->indexBy,
            JoinTable::of($this, $name),
            $this->joinTable,
            $this->inverseJoinColumns,
            $this->orderBy,
        );
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
            $this->indexBy,
            $this->joinTable,
            JoinColumns::of($this, JoinColumn::of(
                $name,
                $referencedColumnName,
                $unique,
                $nullable,
                $onDelete,
                $columnDefinition,
                $options,
            )),
            $this->inverseJoinColumns,
            $this->orderBy,
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
            $this->indexBy,
            $this->joinTable,
            JoinColumns::of($this, ...$joinColumns),
            $this->inverseJoinColumns,
            $this->orderBy,
        );
    }

    /**
     * @param ?non-empty-string $name Name of the column that holds the foreign key for this relation.
     * @param non-empty-string $referencedColumnName Name of the primary key that is used for joining of this relation.
     * @param ?non-empty-string $columnDefinition SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param non-empty-array<non-empty-string,mixed>|null $options Platform specific options.
     *
     * @throws DoctrineMappingException
     */
    public function withInverseJoinColumn(
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
            $this->indexBy,
            $this->joinTable,
            $this->joinColumns,
            JoinColumns::of($this, JoinColumn::of(
                $name,
                $referencedColumnName,
                $unique,
                $nullable,
                $onDelete,
                $columnDefinition,
                $options,
            )),
            $this->orderBy,
        );
    }

    /**
     * @param non-empty-list<JoinColumn> $joinColumns
     *
     * @throws DoctrineMappingException
     */
    public function withInverseJoinColumns(
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
            $this->indexBy,
            $this->joinTable,
            $this->joinColumns,
            JoinColumns::of($this, ...$joinColumns),
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
            $this->targetEntity,
            $this->mappedBy,
            $this->inversedBy,
            $this->cascade,
            $this->fetch,
            $this->orphanRemoval,
            $this->indexBy,
            $this->joinTable,
            $this->joinColumns,
            $this->inverseJoinColumns,
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

    /**
     * @return non-empty-string|null
     */
    public function indexBy(): ?string
    {
        return $this->indexBy;
    }

    public function joinTable(): ?JoinTable
    {
        return $this->joinTable;
    }

    public function joinColumns(): ?JoinColumns
    {
        return $this->joinColumns;
    }

    public function inverseJoinColumns(): ?JoinColumns
    {
        return $this->inverseJoinColumns;
    }

    public function orderBy(): ?OrderBy
    {
        return $this->orderBy;
    }
}
