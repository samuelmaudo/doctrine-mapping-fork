<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\CustomIdGenerator;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedCustomIdGenerator;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class CustomIdGeneratorResolver
{
    /**
     * @throws MappingException
     */
    public static function resolve(
        ReflectionProperty $property,
        ?CustomIdGenerator $customIdGenerator,
    ): ?ResolvedCustomIdGenerator {
        if ($customIdGenerator === null) {
            return null;
        }

        if ($customIdGenerator->class() === null) {
            return new ResolvedCustomIdGenerator(null);
        }

        $class = ClassResolver::resolve($customIdGenerator->class());

        return new ResolvedCustomIdGenerator($class->name);
    }
}
