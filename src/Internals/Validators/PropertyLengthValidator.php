<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyLengthValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?positive-int $length
     */
    public static function validate(
        ReflectionProperty $property,
        ?int $length,
    ): void {
        if ($length !== null && $length < 1) {
            throw MappingException::nonPositiveLength(
                $property->class,
                $property->name,
            );
        }
    }
}
