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
 * @psalm-immutable
 *
 * @internal
 */
abstract class AbstractEntity implements EntityLike
{
    protected function __construct(
        private ReflectionClass $class,
        private ?ReflectionClass $repositoryClass,
        private Table $table,
        private Fields $fields,
        private Associations $associations,
        private Embeddables $embeddedEmbeddables,
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
    ): static {
        $classReflection = ClassResolver::resolve($class);
        return new static(
            $classReflection,
            RepositoryClassResolver::resolve($repositoryClass),
            Table::empty($classReflection),
            Fields::empty(),
            Associations::empty(),
            Embeddables::empty(),
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
     * @param non-empty-list<FieldLike> $fields
     *
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
     * @param non-empty-list<AssociationLike> $associations
     *
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
     * @param non-empty-list<Index> $indexes
     *
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
     * @param non-empty-list<UniqueConstraint> $uniqueConstraints
     *
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
