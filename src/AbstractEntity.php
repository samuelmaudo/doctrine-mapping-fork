<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\AssociationLike;
use Hereldar\DoctrineMapping\Interfaces\EntityLike;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;
use Hereldar\DoctrineMapping\Internals\Resolvers\RepositoryClassResolver;
use ReflectionClass;

/**
 * @internal
 */
abstract class AbstractEntity implements EntityLike
{
    /**
     * @phpstan-param ReflectionClass<object> $class
     * @param ReflectionClass<EntityRepository<object>>|null $repositoryClass
     */
    final protected function __construct(
        private readonly ReflectionClass $class,
        private readonly ?ReflectionClass $repositoryClass,
        private readonly Table $table,
        private readonly Fields $fields,
        private readonly Associations $associations,
        private readonly Embeddables $embeddedEmbeddables,
        private readonly Indexes $indexes,
        private readonly UniqueConstraints $uniqueConstraints,
    ) {}

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     * @param class-string<EntityRepository<T>>|null $repositoryClass
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $class,
        ?string $repositoryClass = null,
    ): static {
        $classReflection = ClassResolver::resolve($class);

        return new static(
            $classReflection,
            RepositoryClassResolver::resolve($repositoryClass),
            Table::empty(),
            Fields::empty(),
            Associations::empty(),
            Embeddables::empty(),
            Indexes::empty(),
            UniqueConstraints::empty(),
        );
    }

    /**
     * @param non-empty-string|null $name name of the table
     * @param non-empty-string|null $schema name of the schema that contains the table
     * @param non-empty-array<non-empty-string,mixed>|null $options platform specific options
     *
     * @throws DoctrineMappingException
     */
    public function withTable(
        ?string $name = null,
        ?string $schema = null,
        ?array $options = null,
    ): static {
        return new static(
            $this->class,
            $this->repositoryClass,
            Table::of($this, $name, $schema, $options),
            $this->fields,
            $this->associations,
            $this->embeddedEmbeddables,
            $this->indexes,
            $this->uniqueConstraints,
        );
    }

    /**
     * @throws DoctrineMappingException
     */
    public function withFields(
        FieldLike ...$fields,
    ): static {
        $fieldCollection = Fields::of($this, ...$fields);

        return new static(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $fieldCollection,
            $this->associations,
            Embeddables::fromFields($fieldCollection),
            $this->indexes,
            $this->uniqueConstraints,
        );
    }

    /**
     * @throws DoctrineMappingException
     */
    public function withAssociations(
        AssociationLike ...$associations,
    ): static {
        $associationCollection = Associations::of($this, ...$associations);

        return new static(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->fields,
            $associationCollection,
            $this->embeddedEmbeddables,
            $this->indexes,
            $this->uniqueConstraints,
        );
    }

    /**
     * @throws DoctrineMappingException
     */
    public function withIndexes(
        Index ...$indexes,
    ): static {
        return new static(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->fields,
            $this->associations,
            $this->embeddedEmbeddables,
            Indexes::of($this, ...$indexes),
            $this->uniqueConstraints,
        );
    }

    /**
     * @throws DoctrineMappingException
     */
    public function withUniqueConstraints(
        UniqueConstraint ...$uniqueConstraints,
    ): static {
        return new static(
            $this->class,
            $this->repositoryClass,
            $this->table,
            $this->fields,
            $this->associations,
            $this->embeddedEmbeddables,
            $this->indexes,
            UniqueConstraints::of($this, ...$uniqueConstraints),
        );
    }

    /**
     * @return ReflectionClass<object>
     */
    public function class(): ReflectionClass
    {
        return $this->class;
    }

    /**
     * @return class-string
     */
    public function className(): string
    {
        return $this->class->name;
    }

    /**
     * @return non-empty-string
     */
    public function classShortName(): string
    {
        /** @var non-empty-string */
        return $this->class->getShortName();
    }

    /**
     * @return ReflectionClass<EntityRepository<object>>|null
     */
    public function repositoryClass(): ?ReflectionClass
    {
        return $this->repositoryClass;
    }

    /**
     * @return class-string<EntityRepository<object>>|null
     */
    public function repositoryClassName(): ?string
    {
        return $this->repositoryClass?->name;
    }

    /**
     * @return non-empty-string|null
     */
    public function repositoryClassShortName(): ?string
    {
        /** @var non-empty-string */
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

    public function associations(): Associations
    {
        return $this->associations;
    }

    public function embeddedEmbeddables(): Embeddables
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
