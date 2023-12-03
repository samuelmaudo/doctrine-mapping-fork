<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyNullableResolver
{
    /**
     * @throws MappingException
     */
    public static function resolve(
        ReflectionProperty $property,
        ?bool $fieldAllowsNulls,
    ): bool {
        $propertyAllowsNulls = $property->getType()?->allowsNull();

        if ($fieldAllowsNulls === false
            && $propertyAllowsNulls === true) {
            throw MappingException::nullableProperty($property->class, $property->name);
        }

        return $fieldAllowsNulls ?? $propertyAllowsNulls ?? false;
    }
}
