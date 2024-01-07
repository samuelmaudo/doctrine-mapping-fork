<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyColumnDefinitionValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?non-empty-string $columnDefinition
     */
    public static function validate(
        ReflectionProperty $property,
        ?string $columnDefinition,
    ): void {
        if ($columnDefinition === '') {
            throw MappingException::emptyColumnDefinition(
                $property->class,
                $property->name,
            );
        }
    }
}
