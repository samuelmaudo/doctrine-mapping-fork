<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyScaleValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?positive-int $scale
     */
    public static function validate(
        ReflectionProperty $property,
        ?int $scale,
        ?int $precision,
    ): void {
        if ($scale === null) {
            return;
        }
        if ($scale < 1) {
            throw MappingException::nonPositiveScale(
                $property->class,
                $property->name,
            );
        }
        if ($scale > $precision) {
            throw MappingException::scaleGreaterThanPrecision(
                $property->class,
                $property->name,
            );
        }
    }
}
