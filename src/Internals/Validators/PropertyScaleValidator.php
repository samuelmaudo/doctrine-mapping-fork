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
     * @psalm-assert positive-int $scale
     */
    public static function validate(
        ReflectionProperty $property,
        ?int $scale,
    ): void {
        if ($scale !== null && $scale < 1) {
            throw MappingException::nonPositiveScale(
                $property->class,
                $property->name,
            );
        }
    }
}
