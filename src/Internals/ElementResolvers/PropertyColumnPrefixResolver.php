<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use ReflectionProperty;

use function Hereldar\DoctrineMapping\to_snake_case;

/**
 * @internal
 */
final class PropertyColumnPrefixResolver
{
    /**
     * @param string|false|null $columnPrefix
     * @return non-empty-string|false
     */
    public static function resolve(
        ReflectionProperty $property,
        string|bool|null $columnPrefix = null,
    ): string|bool {
        if ($columnPrefix === null) {
            $columnPrefix = to_snake_case($property->name).'_';
        }

        return $columnPrefix;
    }
}
