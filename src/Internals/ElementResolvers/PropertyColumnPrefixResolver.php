<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use ReflectionProperty;
use voku\helper\ASCII;

/**
 * @internal
 */
final class PropertyColumnPrefixResolver
{
    /**
     * @param string|false|null $columnPrefix
     * @param string|false $parentColumnPrefix
     * @return non-empty-string|false
     */
    public static function resolve(
        ReflectionProperty $property,
        string|bool|null $columnPrefix = null,
        string|bool $parentColumnPrefix = false,
    ): string|bool {
        if ($columnPrefix === null) {
            $columnPrefix = ASCII::to_slugify($property->name, separator: '_').'_';
        }

        if ($parentColumnPrefix && $columnPrefix) {
            $columnPrefix = "{$parentColumnPrefix}{$columnPrefix}";
        }

        return $columnPrefix;
    }
}
