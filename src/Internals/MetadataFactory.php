<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals;

use Doctrine\Persistence\Mapping\ClassMetadata;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbedded;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEntity;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedField;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedMappedSuperclass;

/**
 * @internal
 */
final class MetadataFactory
{
    public static function fillMetadataObject(
        ResolvedMappedSuperclass|ResolvedEntity|ResolvedEmbeddable $entity,
        ClassMetadata $metadata,
    ): void {
        if ($entity instanceof ResolvedEntity) {
            self::fillEntity($entity, $metadata);
        } elseif ($entity instanceof ResolvedMappedSuperclass) {
            self::fillMappedSuperClass($entity, $metadata);
        } else {
            self::fillEmbeddable($entity, $metadata);
        }
    }

    public static function fillEntity(
        ResolvedMappedSuperclass|ResolvedEntity|ResolvedEmbeddable $entity,
        ClassMetadata $metadata,
    ): void {
        $metadata->setCustomRepositoryClass($entity->repositoryClass);

        self::fillFields($entity, $metadata);
        self::fillPrimaryTable($entity, $metadata);
    }

    public static function fillMappedSuperClass(
        ResolvedMappedSuperclass|ResolvedEntity|ResolvedEmbeddable $entity,
        ClassMetadata $metadata,
    ): void {
        $metadata->isMappedSuperclass = true;

        $metadata->setCustomRepositoryClass($entity->repositoryClass);

        self::fillFields($entity, $metadata);
        self::fillPrimaryTable($entity, $metadata);
    }

    public static function fillEmbeddable(
        ResolvedEmbeddable $entity,
        ClassMetadata $metadata,
    ): void {
        $metadata->isEmbeddedClass = true;

        self::fillFields($entity, $metadata);
    }

    private static function fillFields(
        ResolvedMappedSuperclass|ResolvedEntity|ResolvedEmbeddable $entity,
        ClassMetadata $metadata,
    ): void {
        foreach ($entity->fields as $field) {
            if ($field instanceof ResolvedField) {
                $metadata->mapField([
                    'fieldName' => $field->property,
                    'columnName' => $field->column,
                    'columnDefinition' => $field->columnDefinition,
                    'type' => $field->type,
                    'enumType' => $field->enumType,
                    'id' => $field->id,
                    'unique' => $field->unique,
                    'nullable' => $field->nullable,
                    'notInsertable' => ($field->insertable === false),
                    'notUpdatable' => ($field->updatable === false),
                    'generated' => $field->generated?->value(),
                    'length' => $field->length,
                    'precision' => $field->precision,
                    'scale' => $field->scale,
                    'options' => [
                        'default' => $field->default,
                        'unsigned' => $field->unsigned,
                        'fixed' => $field->fixed,
                        'charset' => $field->charset,
                        'collation' => $field->collation,
                        'comment' => $field->comment,
                    ],
                ]);
                if ($field->strategy) {
                    $metadata->setIdGeneratorType($field->strategy->value());
                }
                if ($field->id && $field->sequenceGenerator) {
                    $metadata->setSequenceGeneratorDefinition([
                        'sequenceName' => $field->sequenceGenerator->sequenceName,
                        'allocationSize' => $field->sequenceGenerator->allocationSize,
                        'initialValue' => $field->sequenceGenerator->initialValue,
                    ]);
                }
                if ($field->id && $field->customIdGenerator) {
                    $metadata->setCustomGeneratorDefinition([
                        'class' => $field->customIdGenerator->class,
                    ]);
                }
            } elseif ($field instanceof ResolvedEmbedded) {
                $metadata->mapEmbedded([
                    'fieldName' => $field->property,
                    'class' => $field->class,
                    'columnPrefix' => $field->columnPrefix,
                ]);
            }
        }
    }

    private static function fillPrimaryTable(
        ResolvedMappedSuperclass|ResolvedEntity $entity,
        ClassMetadata $metadata
    ): void {
        $primaryTable = [
            'name' => $entity->table,
            'schema' => $entity->schema,
            'options' => $entity->options,
        ];

        foreach ($entity->indexes as $index) {
            $idx = [
                'fields' => $index->fields,
                'columns' => $index->columns,
                'flags' => $index->flags,
                'options' => $index->options,
            ];
            if ($index->name) {
                $primaryTable['indexes'][$index->name] = $idx;
            } else {
                $primaryTable['indexes'][] = $idx;
            }
        }

        foreach ($entity->uniqueConstraints as $uniqueConstraint) {
            $uniq = [
                'fields' => $uniqueConstraint->fields,
                'columns' => $uniqueConstraint->columns,
                'options' => $uniqueConstraint->options,
            ];
            if ($uniqueConstraint->name) {
                $primaryTable['uniqueConstraints'][$uniqueConstraint->name] = $uniq;
            } else {
                $primaryTable['uniqueConstraints'][] = $uniq;
            }
        }

        $metadata->setPrimaryTable($primaryTable);
    }
}
