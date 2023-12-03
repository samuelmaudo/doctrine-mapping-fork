<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use ReflectionClass;
use voku\helper\ASCII;

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

        return ASCII::to_slugify($class->getShortName(), separator: '_');
    }
}
