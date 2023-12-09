<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use ReflectionClass;

use function Hereldar\DoctrineMapping\to_snake_case;

/**
 * @internal
 */
final class ClassTableResolver
{
    /**
     * @param ?non-empty-string $table
     *
     * @return non-empty-string
     */
    public static function resolve(
        ReflectionClass $class,
        ?string $table,
    ): string {
        if ($table) {
            return $table;
        }

        return to_snake_case($class->getShortName());
    }
}
