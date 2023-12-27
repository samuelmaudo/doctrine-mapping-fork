<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedField;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyLengthValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyPrecisionValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyScaleValidator;
use ReflectionClass;

/**
 * @internal
 */
final class FieldResolver
{
    /**
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        Field $field,
    ): ResolvedField {
        $property = PropertyResolver::resolve($class, $field->property());

        $column = PropertyColumnResolver::resolve($property, $field->column());
        $nullable = PropertyNullableResolver::resolve($property, $field->nullable(), $field->primaryKey());
        PropertyLengthValidator::validate($property, $field->length());
        PropertyPrecisionValidator::validate($property, $field->precision());
        PropertyScaleValidator::validate($property, $field->scale());

        return new ResolvedField(
            property: $field->property(),
            column: $column,
            type: $field->type() ?: null,
            primaryKey: $field->primaryKey(),
            unique: $field->unique(),
            nullable: $nullable,
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
