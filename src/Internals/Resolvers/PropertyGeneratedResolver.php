<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Error;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyGeneratedResolver
{
    /**
     * @throws MappingException
     */
    public static function resolve(
        ReflectionProperty $property,
        int|string|null $generated,
    ): ?Generated {
        if ($generated === null) {
            return null;
        }

        try {
            return Generated::from($generated);
        } catch (Error) {
            throw MappingException::invalidGenerationMode(
                $property->class,
                $property->name,
                $generated,
            );
        }
    }
}
