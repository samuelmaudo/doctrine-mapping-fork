<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use ReflectionClass;

use function Hereldar\DoctrineMapping\Internals\to_snake_case;

/**
 * @internal
 */
final class ClassTableResolver
{
    /**
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
