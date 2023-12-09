<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use ReflectionProperty;

use function Hereldar\DoctrineMapping\to_snake_case;

/**
 * @internal
 */
final class PropertyColumnResolver
{
    /**
     * @param ?non-empty-string $column
     *
     * @return non-empty-string
     */
    public static function resolve(
        ReflectionProperty $property,
        ?string $column = null,
    ): string {
        if (!$column) {
            $column = to_snake_case($property->name);
        }

        return $column;
    }
}
