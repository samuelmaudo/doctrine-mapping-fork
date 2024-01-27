<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
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
        if ($column === null) {
            return to_snake_case($property->name);
        }

        if ($column === '') {
            throw MappingException::emptyColumn($property->class, $property->name);
        }

        return $column;
    }
}
