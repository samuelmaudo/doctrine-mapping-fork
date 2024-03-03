<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
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
        bool $id = false,
    ): bool {
        if ($nullable === null) {
            $nullable = $property->getType()?->allowsNull() ?? false;
        }

        if ($nullable && $id) {
            throw MappingException::nullableId($property->class, $property->name);
        }

        return $nullable;
    }
}
