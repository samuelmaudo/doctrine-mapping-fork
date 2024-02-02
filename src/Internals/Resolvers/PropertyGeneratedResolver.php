<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Enums\Generated;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyGeneratedResolver
{
    public static function resolve(
        ReflectionProperty $property,
        int|string|null $resolved,
    ): ?Generated {
        return Generated::tryFrom($resolved);
    }
}
