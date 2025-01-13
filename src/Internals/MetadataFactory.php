<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals;

use Doctrine\ORM\Mapping\ClassMetadata as OrmClassMetadata;
use Doctrine\ORM\Mapping\MappingException as OrmMappingException;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Association;
use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\JoinColumns;
use Hereldar\DoctrineMapping\ManyToMany;
use Hereldar\DoctrineMapping\ManyToOne;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\OneToMany;
use Hereldar\DoctrineMapping\OneToOne;

/**
 * @internal
 */
final class MetadataFactory
{
    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    public static function fillMetadataObject(
        Entity|MappedSuperclass|Embeddable $entity,
        OrmClassMetadata $metadata,
    ): void {
        if ($entity instanceof Entity) {
            self::fillEntity($entity, $metadata);
        } elseif ($entity instanceof MappedSuperclass) {
            self::fillMappedSuperClass($entity, $metadata);
        } else {
            self::fillEmbeddable($entity, $metadata);
        }
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    public static function fillEntity(
        Entity $entity,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->setCustomRepositoryClass($entity->repositoryClassName());

        self::fillFields($entity, $metadata);
        self::fillAssociations($entity, $metadata);
        self::fillPrimaryTable($entity, $metadata);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    public static function fillMappedSuperClass(
        MappedSuperclass $superclass,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->isMappedSuperclass = true;

        $metadata->setCustomRepositoryClass($superclass->repositoryClassName());

        self::fillFields($superclass, $metadata);
        self::fillAssociations($superclass, $metadata);
        self::fillPrimaryTable($superclass, $metadata);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    public static function fillEmbeddable(
        Embeddable $embeddable,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->isEmbeddedClass = true;

        self::fillFields($embeddable, $metadata);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillFields(
        Entity|MappedSuperclass|Embeddable $entity,
        OrmClassMetadata $metadata,
    ): void {
        foreach ($entity->fields() as $field) {
            if ($field instanceof AbstractField) {
                self::fillField($field, $metadata);
            } elseif ($field instanceof AbstractId) {
                self::fillField($field, $metadata);
            } elseif ($field instanceof Embedded) {
                self::fillEmbedded($field, $metadata);
            }
        }
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillField(
        AbstractField|AbstractId $field,
        OrmClassMetadata $metadata,
    ): void {
        $column = $field->column();

        $metadata->mapField([
            'fieldName' => $field->property(),
            'columnName' => $column->name(),
            'columnDefinition' => $column->definition(),
            'type' => $field->type(),
            'enumType' => $field->enumType(),
            'id' => $field->id(),
            'unique' => $column->unique(),
            'nullable' => $column->nullable(),
            'notInsertable' => (false === $field->insertable()),
            'notUpdatable' => (false === $field->updatable()),
            'generated' => $field->generated()?->internalValue(),
            'length' => $column->length(),
            'precision' => $column->precision(),
            'scale' => $column->scale(),
            'options' => [
                'default' => $column->default(),
                'unsigned' => $column->unsigned(),
                'fixed' => $column->fixed(),
                'charset' => $column->charset(),
                'collation' => $column->collation(),
                'comment' => $column->comment(),
            ],
        ]);

        if ($field instanceof AbstractId) {
            self::fillId($field, $metadata);
        }
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillId(
        AbstractId $id,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->setIdGeneratorType($id->strategy()->internalValue());

        if ($id->id() && $id->sequenceGenerator()) {
            // @phpstan-ignore argument.type
            $metadata->setSequenceGeneratorDefinition([
                'sequenceName' => $id->sequenceGenerator()->sequenceName(),
                'allocationSize' => $id->sequenceGenerator()->allocationSize(),
                'initialValue' => $id->sequenceGenerator()->initialValue(),
            ]);
        }
        if ($id->id() && $id->customIdGenerator()) {
            $metadata->setCustomGeneratorDefinition([
                'class' => $id->customIdGenerator(),
            ]);
        }
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillEmbedded(
        Embedded $embedded,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->mapEmbedded([
            'fieldName' => $embedded->property(),
            'class' => $embedded->className(),
            'columnPrefix' => $embedded->columnPrefix(),
        ]);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillAssociations(
        Entity|MappedSuperclass $entity,
        OrmClassMetadata $metadata,
    ): void {
        foreach ($entity->associations() as $association) {
            self::fillAssociation($association, $metadata);
        }
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillAssociation(
        Association $association,
        OrmClassMetadata $metadata,
    ): void {
        if ($association instanceof OneToOne) {
            self::fillOneToOne($association, $metadata);
        } elseif ($association instanceof OneToMany) {
            self::fillOneToMany($association, $metadata);
        } elseif ($association instanceof ManyToOne) {
            self::fillManyToOne($association, $metadata);
        } elseif ($association instanceof ManyToMany) {
            self::fillManyToMany($association, $metadata);
        }
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillOneToOne(
        OneToOne $oneToOne,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->mapOneToOne([
            'fieldName' => $oneToOne->property(),
            'targetEntity' => $oneToOne->targetEntityName(),
            'joinColumns' => self::serializeJoinColumns(
                $oneToOne->joinColumns()
            ),
            'mappedBy' => $oneToOne->mappedBy(),
            'inversedBy' => $oneToOne->inversedBy(),
            'cascade' => \array_map(
                static fn (Cascade $option): string => $option->value,
                $oneToOne->cascade(),
            ),
            'orphanRemoval' => $oneToOne->orphanRemoval(),
            'fetch' => $oneToOne->fetch()->internalValue(),
        ]);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillOneToMany(
        OneToMany $oneToMany,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->mapOneToMany([
            'fieldName' => $oneToMany->property(),
            'mappedBy' => $oneToMany->mappedBy(),
            'targetEntity' => $oneToMany->targetEntity(),
            'cascade' => \array_map(
                static fn (Cascade $option): string => $option->value,
                $oneToMany->cascade(),
            ),
            'indexBy' => $oneToMany->indexBy(),
            'orphanRemoval' => $oneToMany->orphanRemoval(),
            'fetch' => $oneToMany->fetch()->internalValue(),
            'orderBy' => $oneToMany->orderBy()?->value(),
        ]);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillManyToOne(
        ManyToOne $manyToOne,
        OrmClassMetadata $metadata,
    ): void {
        $metadata->mapManyToOne([
            'fieldName' => $manyToOne->property(),
            'joinColumns' => self::serializeJoinColumns(
                $manyToOne->joinColumns()
            ),
            'cascade' => \array_map(
                static fn (Cascade $option): string => $option->value,
                $manyToOne->cascade(),
            ),
            'inversedBy' => $manyToOne->inversedBy(),
            'targetEntity' => $manyToOne->targetEntity(),
            'fetch' => $manyToOne->fetch()->internalValue(),
        ]);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     *
     * @throws OrmMappingException
     */
    private static function fillManyToMany(
        ManyToMany $manyToMany,
        OrmClassMetadata $metadata,
    ): void {
        $joinTable = [];

        if ($manyToMany->joinTable()) {
            $joinTable['name'] = $manyToMany->joinTable()->name();
        }

        if ($manyToMany->joinColumns()) {
            $joinTable['joinColumns'] = self::serializeJoinColumns(
                $manyToMany->joinColumns()
            );
        }

        if ($manyToMany->inverseJoinColumns()) {
            $joinTable['inverseJoinColumns'] = self::serializeJoinColumns(
                $manyToMany->inverseJoinColumns()
            );
        }

        $metadata->mapManyToMany([
            'fieldName' => $manyToMany->property(),
            'joinTable' => $joinTable,
            'targetEntity' => $manyToMany->targetEntity(),
            'mappedBy' => $manyToMany->mappedBy(),
            'inversedBy' => $manyToMany->inversedBy(),
            'cascade' => \array_map(
                static fn (Cascade $option): string => $option->value,
                $manyToMany->cascade(),
            ),
            'indexBy' => $manyToMany->indexBy(),
            'orphanRemoval' => $manyToMany->orphanRemoval(),
            'fetch' => $manyToMany->fetch()->internalValue(),
            'orderBy' => $manyToMany->orderBy()?->value(),
        ]);
    }

    /**
     * @phpstan-param OrmClassMetadata<object> $metadata
     */
    private static function fillPrimaryTable(
        Entity|MappedSuperclass $entity,
        OrmClassMetadata $metadata,
    ): void {
        $table = $entity->table();

        $primaryTable = [
            'name' => $table->name(),
            'schema' => $table->schema(),
            'options' => $table->options(),
        ];

        foreach ($entity->indexes() as $index) {
            $idx = [
                'fields' => $index->fields(),
                'columns' => $index->columns(),
                'flags' => $index->flags(),
                'options' => $index->options(),
            ];
            if ($index->name()) {
                $primaryTable['indexes'][$index->name()] = $idx;
            } else {
                $primaryTable['indexes'][] = $idx;
            }
        }

        foreach ($entity->uniqueConstraints() as $uniqueConstraint) {
            $uniq = [
                'fields' => $uniqueConstraint->fields(),
                'columns' => $uniqueConstraint->columns(),
                'options' => $uniqueConstraint->options(),
            ];
            if ($uniqueConstraint->name()) {
                $primaryTable['uniqueConstraints'][$uniqueConstraint->name()] = $uniq;
            } else {
                $primaryTable['uniqueConstraints'][] = $uniq;
            }
        }

        $metadata->setPrimaryTable($primaryTable);
    }

    /**
     * @return list<array{
     *     name: non-empty-string|null,
     *     unique: bool|null,
     *     nullable: bool,
     *     onDelete: mixed,
     *     columnDefinition: non-empty-string|null,
     *     referencedColumnName: non-empty-string,
     *     options: array<non-empty-string,mixed>,
     * }>|null
     */
    private static function serializeJoinColumns(?JoinColumns $joinColumns): ?array
    {
        if (null === $joinColumns) {
            return null;
        }

        $mapping = [];

        foreach ($joinColumns as $joinColumn) {
            $mapping[] = [
                'name' => $joinColumn->name(),
                'unique' => $joinColumn->unique(),
                'nullable' => $joinColumn->nullable(),
                'onDelete' => $joinColumn->onDelete(),
                'columnDefinition' => $joinColumn->columnDefinition(),
                'referencedColumnName' => $joinColumn->referencedColumnName(),
                'options' => $joinColumn->options(),
            ];
        }

        return $mapping;
    }
}
