<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedField;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyCharsetValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyCollationValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyColumnDefinitionValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyCommentValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyLengthValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyPrecisionValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyScaleValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyTypeValidator;
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
        PropertyColumnDefinitionValidator::validate($property, $field->columnDefinition());
        PropertyTypeValidator::validate($property, $field->type());
        $nullable = PropertyNullableResolver::resolve($property, $field->nullable(), $field->primaryKey());
        PropertyLengthValidator::validate($property, $field->length());
        PropertyPrecisionValidator::validate($property, $field->precision(), $field->scale());
        PropertyScaleValidator::validate($property, $field->scale(), $field->precision());
        PropertyCharsetValidator::validate($property, $field->charset());
        PropertyCollationValidator::validate($property, $field->collation());

        return new ResolvedField(
            property: $field->property(),
            column: $column,
            columnDefinition: $field->columnDefinition(),
            type: $field->type(),
            enumType: $field->enumType(),
            primaryKey: $field->primaryKey(),
            unique: $field->unique(),
            nullable: $nullable,
            insertable: $field->insertable(),
            updatable: $field->updatable(),
            generated: $field->generated(),
            length: $field->length(),
            precision: $field->precision(),
            scale: $field->scale(),
            default: $field->default(),
            unsigned: $field->unsigned(),
            fixed: $field->fixed(),
            charset: $field->charset(),
            collation: $field->collation(),
            comment: $field->comment() ?: null,
        );
    }
}
