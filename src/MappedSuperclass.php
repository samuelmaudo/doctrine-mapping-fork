<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;
use Hereldar\DoctrineMapping\Internals\Resolvers\RepositoryClassResolver;
use ReflectionClass;

/**
 * @psalm-immutable
 */
final class MappedSuperclass
{
    private function __construct(
        private ReflectionClass $class,
        private ?ReflectionClass $repositoryClass,
        private Table $table,
        private Fields $fields,
        private EmbeddedEmbeddables $embeddedEmbeddables,
        private Indexes $indexes,
        private UniqueConstraints $uniqueConstraints,
    ) {}

    /**
     * @param class-string $class
     * @param ?class-string<EntityRepository> $repositoryClass
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $class,
        ?string $repositoryClass = null,
    ): self {
        $classReflection = ClassResolver::resolve($class);
        return new self(
            $classReflection,
            RepositoryClassResolver::resolve($repositoryClass),
            Table::empty($classReflection),
            Fields::empty(),
            EmbeddedEmbeddables::empty(),
            Indexes::empty(),
            UniqueConstraints::empty(),
        );
    }

    /**
     * @param ?non-empty-string $name Name of the table.
     * @param ?non-empty-string $schema Name of the schema that contains the table.
     * @param non-empty-array<non-empty-string,mixed>|null $options Platform specific options.
     *
     * @throws DoctrineMappingException
     */
    public function withTable(
        ?string $name = null,
        ?string $schema = null,
        array|null $options = null,
    ): self {
        return new self(
            $this->class,
            $this->repositoryClass,
            Table::of($this, $name, $schema, $options),
            $this->fields,
            $this->embeddedEmbeddables,
            $this->indexes,
            $this->uniqueConstraints,
        );
    }

    /**
     * @param non-empty-list<Field|Embedded> $fields
     *
     * @throws DoctrineMappingException
     */
    public function withFields(
        Field|Embedded ...$fields,
    ): self {
        $fieldCollection = Fields::of($this, ...$fields);

        return new self(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $fieldCollection,
            EmbeddedEmbeddables::of($fieldCollection),
            $this->indexes,
            $this->uniqueConstraints,
        );
    }

    /**
     * @param non-empty-list<Index> $indexes
     *
     * @throws DoctrineMappingException
     */
    public function withIndexes(
        Index ...$indexes,
    ): self {
        return new self(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->fields,
            $this->embeddedEmbeddables,
            Indexes::of($this, ...$indexes),
            $this->uniqueConstraints,
        );
    }

    /**
     * @param non-empty-list<UniqueConstraint> $uniqueConstraints
     *
     * @throws DoctrineMappingException
     */
    public function withUniqueConstraints(
        UniqueConstraint ...$uniqueConstraints,
    ): self {
        return new self(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->fields,
            $this->embeddedEmbeddables,
            $this->indexes,
            UniqueConstraints::of($this, ...$uniqueConstraints),
        );
    }

    public function class(): ReflectionClass
    {
        return $this->class;
    }

    public function className(): string
    {
        return $this->class->name;
    }

    public function classSortName(): string
    {
        return $this->class->getShortName();
    }

    public function repositoryClass(): ?ReflectionClass
    {
        return $this->repositoryClass;
    }

    public function repositoryClassName(): ?string
    {
        return $this->repositoryClass?->name;
    }

    public function repositoryClassShortName(): ?string
    {
        return $this->repositoryClass?->getShortName();
    }

    public function table(): Table
    {
        return $this->table;
    }

    public function fields(): Fields
    {
        return $this->fields;
    }

    public function embeddedEmbeddables(): EmbeddedEmbeddables
    {
        return $this->embeddedEmbeddables;
    }

    public function indexes(): Indexes
    {
        return $this->indexes;
    }

    public function uniqueConstraints(): UniqueConstraints
    {
        return $this->uniqueConstraints;
    }
}
