<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Internals\Exceptions\FalseTypeError;
use ReflectionProperty;
use function Hereldar\DoctrineMapping\Internals\to_snake_case;

/**
 * @internal
 */
final class PropertyColumnPrefixResolver
{
    /**
     * @return non-empty-string|false
     */
    public static function resolve(
        ReflectionProperty $property,
        string|bool|null $columnPrefix,
    ): string|bool {
        if ($columnPrefix === true) {
            throw new FalseTypeError('PropertyColumnPrefixResolver::resolve()', 2, '$columnPrefix');
        }

        if ($columnPrefix === false || $columnPrefix) {
            return $columnPrefix;
        }

        return to_snake_case($property->name).'_';
    }
}
