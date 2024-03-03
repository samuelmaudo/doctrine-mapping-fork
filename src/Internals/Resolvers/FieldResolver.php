<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedField;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyCharsetValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyCollationValidator;
use Hereldar\DoctrineMapping\Internals\Validators\PropertyColumnDefinitionValidator;
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
        $nullable = PropertyNullableResolver::resolve($property, $field->nullable(), $field->id());
        $generated = PropertyGeneratedResolver::resolve($property, $field->generated());
        $strategy = PropertyStrategyResolver::resolve($property, $field->strategy());
        PropertyLengthValidator::validate($property, $field->length());
        PropertyPrecisionValidator::validate($property, $field->precision(), $field->scale());
        PropertyScaleValidator::validate($property, $field->scale(), $field->precision());
        PropertyCharsetValidator::validate($property, $field->charset());
        PropertyCollationValidator::validate($property, $field->collation());
        $sequenceGenerator = SequenceGeneratorResolver::resolve($property, $field->sequenceGenerator());
        $customIdGenerator = CustomIdGeneratorResolver::resolve($property, $field->customIdGenerator());

        return new ResolvedField(
            property: $field->property(),
            column: $column,
            columnDefinition: $field->columnDefinition(),
            type: $field->type(),
            enumType: $field->enumType(),
            id: $field->id(),
            unique: $field->unique(),
            nullable: $nullable,
            insertable: $field->insertable(),
            updatable: $field->updatable(),
            generated: $generated,
            strategy: $strategy,
            length: $field->length(),
            precision: $field->precision(),
            scale: $field->scale(),
            default: $field->default(),
            unsigned: $field->unsigned(),
            fixed: $field->fixed(),
            charset: $field->charset(),
            collation: $field->collation(),
            comment: $field->comment() ?: null,
            sequenceGenerator: $sequenceGenerator,
            customIdGenerator: $customIdGenerator,
        );
    }
}
