<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals;

use Doctrine\ORM\Mapping\MappingException as OrmMappingException;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Hereldar\DoctrineMapping\AbstractEntity;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\EntityLike;
use Hereldar\DoctrineMapping\MappedSuperclass;

/**
 * @internal
 */
final class MetadataFactory
{
    /**
     * @throws OrmMappingException
     */
    public static function fillMetadataObject(
        EntityLike $entity,
        ClassMetadata $metadata,
    ): void {
        if ($entity instanceof Entity) {
            self::fillEntity($entity, $metadata);
        } elseif ($entity instanceof MappedSuperclass) {
            self::fillMappedSuperClass($entity, $metadata);
        } elseif ($entity instanceof Embeddable) {
            self::fillEmbeddable($entity, $metadata);
        }
    }

    /**
     * @throws OrmMappingException
     */
    public static function fillEntity(
        Entity $entity,
        ClassMetadata $metadata,
    ): void {
        $metadata->setCustomRepositoryClass($entity->repositoryClassName());

        self::fillFields($entity, $metadata);
        self::fillPrimaryTable($entity, $metadata);
    }

    /**
     * @throws OrmMappingException
     */
    public static function fillMappedSuperClass(
        MappedSuperclass $superclass,
        ClassMetadata $metadata,
    ): void {
        $metadata->isMappedSuperclass = true;

        $metadata->setCustomRepositoryClass($superclass->repositoryClassName());

        self::fillFields($superclass, $metadata);
        self::fillPrimaryTable($superclass, $metadata);
    }

    /**
     * @throws OrmMappingException
     */
    public static function fillEmbeddable(
        Embeddable $embeddable,
        ClassMetadata $metadata,
    ): void {
        $metadata->isEmbeddedClass = true;

        self::fillFields($embeddable, $metadata);
    }

    /**
     * @throws OrmMappingException
     */
    private static function fillFields(
        EntityLike $entity,
        ClassMetadata $metadata,
    ): void {
        foreach ($entity->fields() as $field) {
            if ($field instanceof AbstractField) {
                self::fillField($field, $metadata);
            } elseif ($field instanceof Embedded) {
                self::fillEmbedded($field, $metadata);
            }
        }
    }

    /**
     * @throws OrmMappingException
     */
    private static function fillField(
        AbstractField $field,
        ClassMetadata $metadata,
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
            'notInsertable' => ($field->insertable() === false),
            'notUpdatable' => ($field->updatable() === false),
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
     * @throws OrmMappingException
     */
    private static function fillId(
        AbstractId $id,
        ClassMetadata $metadata,
    ): void {
        $metadata->setIdGeneratorType($id->strategy()->internalValue());

        if ($id->id() && $id->sequenceGenerator()) {
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
     * @throws OrmMappingException
     */
    private static function fillEmbedded(
        Embedded $embedded,
        ClassMetadata $metadata,
    ): void {
        $metadata->mapEmbedded([
            'fieldName' => $embedded->property(),
            'class' => $embedded->className(),
            'columnPrefix' => $embedded->columnPrefix(),
        ]);
    }

    private static function fillPrimaryTable(
        AbstractEntity $entity,
        ClassMetadata $metadata,
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
}
