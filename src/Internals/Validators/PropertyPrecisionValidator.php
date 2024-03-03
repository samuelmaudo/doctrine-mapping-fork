<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyPrecisionValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?positive-int $precision
     */
    public static function validate(
        ReflectionProperty $property,
        ?int $precision,
        ?int $scale,
    ): void {
        if ($precision !== null && $precision < 1) {
            throw MappingException::nonPositivePrecision(
                $property->class,
                $property->name,
            );
        }
        if ($precision === null && $scale !== null) {
            throw MappingException::missingPrecision(
                $property->class,
                $property->name,
            );
        }
    }
}
