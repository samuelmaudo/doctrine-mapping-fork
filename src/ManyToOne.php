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
final class ManyToOne extends Association
{
    /**
     * @param non-empty-string $property
     * @param list<Cascade> $cascade
     * @param non-empty-string|null $inversedBy
     *
     * @internal
     */
    public function __construct(
        protected string $property,
        protected ReflectionClass $targetEntity,
        protected array $cascade,
        protected Fetch $fetch,
        protected ?string $inversedBy,
        protected ?JoinColumns $joinColumns,
    ) {}

    /**
     * @param non-empty-string $property
     * @param class-string|null $targetEntity
     * @param list<Cascade|'all'|'remove'|'persist'|'refresh'|'detach'>|null $cascade
     * @param Fetch|'LAZY'|'EAGER'|'EXTRA_LAZY' $fetch
     * @param non-empty-string|null $inversedBy
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $property,
        ?string $targetEntity = null,
        ?array $cascade = null,
        Fetch|string $fetch = 'LAZY',
        ?string $inversedBy = null,
    ): self|IncompleteManyToOne {
        self::validateProperty($property);
        $targetEntity = ClassResolver::resolveNullable($targetEntity);
        $cascade = self::sanitizeCascade($property, $cascade);
        $fetch = self::sanitizeFetch($property, $fetch);
        self::validateInversedBy($property, $targetEntity, $inversedBy);

        if (null === $targetEntity) {
            return new IncompleteManyToOne($property, $cascade, $fetch, $inversedBy, null);
        }

        return new self($property, $targetEntity, $cascade, $fetch, $inversedBy, null);
    }

    /**
     * @param non-empty-string|null $name name of the column that holds the foreign key for this relation
     * @param non-empty-string $referencedColumnName name of the primary key that is used for joining of this relation
     * @param non-empty-string|null $columnDefinition SQL fragment that is used when generating the DDL for the column (non-portable)
     * @param non-empty-array<non-empty-string,mixed>|null $options platform specific options
     *
     * @throws DoctrineMappingException
     */
    public function withJoinColumn(
        ?string $name = null,
        string $referencedColumnName = 'id',
        bool $unique = false,
        bool $nullable = true,
        mixed $onDelete = null,
        ?string $columnDefinition = null,
        array $options = [],
    ): self {
        return new self(
            $this->property,
            $this->targetEntity,
            $this->cascade,
            $this->fetch,
            $this->inversedBy,
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
            $this->cascade,
            $this->fetch,
            $this->inversedBy,
            JoinColumns::of($this, ...$joinColumns),
        );
    }

    /**
     * @return non-empty-string|null
     */
    public function inversedBy(): ?string
    {
        return $this->inversedBy;
    }

    public function joinColumns(): ?JoinColumns
    {
        return $this->joinColumns;
    }
}
