<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use ReflectionProperty;

use function Hereldar\DoctrineMapping\Internals\to_snake_case;

/**
 * @internal
 */
final class PropertyColumnResolver
{
    /**
     * @return non-empty-string
     */
    public static function resolve(
        ReflectionProperty $property,
        ?string $column,
    ): string {
        if ($column) {
            return $column;
        }

        return to_snake_case($property->name);
    }
}
