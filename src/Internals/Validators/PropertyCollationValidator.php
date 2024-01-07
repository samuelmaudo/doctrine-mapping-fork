<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyCollationValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?non-empty-string $collation
     */
    public static function validate(
        ReflectionProperty $property,
        ?string $collation,
    ): void {
        if ($collation === '') {
            throw MappingException::emptyCollation(
                $property->class,
                $property->name,
            );
        }
    }
}
