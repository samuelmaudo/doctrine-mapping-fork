<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\EntityRepository;

/**
 * @psalm-immutable
 */
final class MappedSuperclass
{
    private function __construct(
        private string $class,
        private ?string $repositoryClass,
        private ?string $table,
        private ?string $schema,
        private ?array $options,
        private array $fields,
        private array $indexes,
        private array $uniqueConstraints,
    ) {}

    /**
     * @param class-string $class
     * @param ?class-string<EntityRepository> $repositoryClass
     * @param ?non-empty-string $table Name of the table.
     * @param ?non-empty-string $schema Name of the schema that contains the table.
     * @param non-empty-array<non-empty-string,mixed>|null $options Platform specific options.
     */
    public static function of(
        string $class,
        ?string $repositoryClass = null,
        ?string $table = null,
        ?string $schema = null,
        array|null $options = null,
    ): self {
        return new self(
            $class,
            $repositoryClass,
            $table,
            $schema,
            $options,
            [],
            [],
            [],
        );
    }

    /**
     * @param non-empty-list<Field|Embedded> $fields
     */
    public function withFields(
        Field|Embedded ...$fields,
    ): self {
        return new self(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->schema,
            $this->options,
            $fields,
            $this->indexes,
            $this->uniqueConstraints,
        );
    }

    /**
     * @param non-empty-list<Index> $indexes
     */
    public function withIndexes(
        Index ...$indexes,
    ): self {
        return new self(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->schema,
            $this->options,
            $this->fields,
            $indexes,
            $this->uniqueConstraints,
        );
    }

    /**
     * @param non-empty-list<UniqueConstraint> $uniqueConstraints
     */
    public function withUniqueConstraints(
        UniqueConstraint ...$uniqueConstraints,
    ): self {
        return new self(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->schema,
            $this->options,
            $this->fields,
            $this->indexes,
            $uniqueConstraints,
        );
    }

    public function class(): string
    {
        return $this->class;
    }

    public function repositoryClass(): ?string
    {
        return $this->repositoryClass;
    }

    public function table(): ?string
    {
        return $this->table;
    }

    public function schema(): ?string
    {
        return $this->schema;
    }

    public function options(): ?array
    {
        return $this->options;
    }

    public function fields(): array
    {
        return $this->fields;
    }

    public function indexes(): array
    {
        return $this->indexes;
    }

    public function uniqueConstraints(): array
    {
        return $this->uniqueConstraints;
    }
}
