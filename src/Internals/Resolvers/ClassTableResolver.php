<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
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

        if ($table === '') {
            throw MappingException::emptyTable($class->name);
        }

        return to_snake_case($class->getShortName());
    }
}
