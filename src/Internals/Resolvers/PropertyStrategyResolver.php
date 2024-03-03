<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Error;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyStrategyResolver
{
    /**
     * @throws MappingException
     */
    public static function resolve(
        ReflectionProperty $property,
        int|string|null $strategy,
    ): ?Strategy {
        if ($strategy === null) {
            return null;
        }

        try {
            return Strategy::from($strategy);
        } catch (Error) {
            throw MappingException::invalidGenerationStrategy(
                $property->class,
                $property->name,
                $strategy,
            );
        }
    }
}
