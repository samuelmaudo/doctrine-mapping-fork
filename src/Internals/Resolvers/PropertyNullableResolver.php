<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

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
        ?bool $nullable,
        bool $primaryKey = false,
    ): bool {
        if ($nullable === null) {
            $nullable = $property->getType()?->allowsNull() ?? false;
        }

        if ($nullable && $primaryKey) {
            throw MappingException::nullablePrimaryKey($property->class, $property->name);
        }

        return $nullable;
    }
}
