<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedField;
use ReflectionClass;

/**
 * @internal
 */
final class FieldResolver
{
    /**
     * @param non-empty-string|false $columnPrefix
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        Field $field,
        string|bool $columnPrefix = false,
    ): ResolvedField {
        $property = PropertyResolver::resolve($class, $field->property());

        return new ResolvedField(
            property: $field->property(),
            column: PropertyColumnResolver::resolve($property, $field->column(), $columnPrefix),
            type: PropertyTypeResolver::resolve($property, $field->type()),
            primaryKey: $field->primaryKey(),
            unique: $field->unique(),
            nullable: PropertyNullableResolver::resolve($property, $field->nullable() && !$field->primaryKey()),
            insertable: $field->insertable(),
            updatable: $field->updatable(),
            length: $field->length(),
            precision: $field->precision(),
            scale: $field->scale(),
            unsigned: $field->unsigned(),
            fixed: $field->fixed(),
        );
    }
}
