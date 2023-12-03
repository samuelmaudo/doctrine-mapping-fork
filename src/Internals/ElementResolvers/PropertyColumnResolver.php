<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use ReflectionProperty;
use voku\helper\ASCII;

/**
 * @internal
 */
final class PropertyColumnResolver
{
    /**
     * @param ?non-empty-string $column
     * @param non-empty-string|false $columnPrefix
     *
     * @return non-empty-string
     */
    public static function resolve(
        ReflectionProperty $property,
        ?string $column = null,
        string|bool $columnPrefix = false,
    ): string {
        if (!$column) {
            $column = ASCII::to_slugify($property->name, separator: '_');
        }

        if ($columnPrefix) {
            $column = "{$columnPrefix}{$column}";
        }

        return $column;
    }
}
