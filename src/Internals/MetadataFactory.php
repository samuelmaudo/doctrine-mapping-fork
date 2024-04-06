<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals;

use Doctrine\ORM\Mapping\MappingException as OrmMappingException;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
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
        MappedSuperclass|Entity|Embeddable $entity,
        ClassMetadata $metadata,
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
        MappedSuperclass $entity,
        ClassMetadata $metadata,
    ): void {
        $metadata->isMappedSuperclass = true;

        $metadata->setCustomRepositoryClass($entity->repositoryClassName());

        self::fillFields($entity, $metadata);
        self::fillPrimaryTable($entity, $metadata);
    }

    /**
     * @throws OrmMappingException
     */
    public static function fillEmbeddable(
        Embeddable $entity,
        ClassMetadata $metadata,
    ): void {
        $metadata->isEmbeddedClass = true;

        self::fillFields($entity, $metadata);
    }

    /**
     * @throws OrmMappingException
     */
    private static function fillFields(
        MappedSuperclass|Entity|Embeddable $entity,
        ClassMetadata $metadata,
    ): void {
        foreach ($entity->fields() as $field) {
            if ($field instanceof Field) {
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
                    'generated' => $field->generated()?->value(),
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

                $metadata->setIdGeneratorType($field->strategy()->value());

                if ($field->id() && $field->sequenceGenerator()) {
                    $metadata->setSequenceGeneratorDefinition([
                        'sequenceName' => $field->sequenceGenerator()->sequenceName(),
                        'allocationSize' => $field->sequenceGenerator()->allocationSize(),
                        'initialValue' => $field->sequenceGenerator()->initialValue(),
                    ]);
                }
                if ($field->id() && $field->customIdGenerator()) {
                    $metadata->setCustomGeneratorDefinition([
                        'class' => $field->customIdGenerator(),
                    ]);
                }
            } elseif ($field instanceof Embedded) {
                $metadata->mapEmbedded([
                    'fieldName' => $field->property(),
                    'class' => $field->className(),
                    'columnPrefix' => $field->columnPrefix(),
                ]);
            }
        }
    }

    private static function fillPrimaryTable(
        MappedSuperclass|Entity $entity,
        ClassMetadata $metadata
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
