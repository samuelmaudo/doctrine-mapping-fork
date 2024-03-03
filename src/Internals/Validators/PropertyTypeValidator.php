<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyTypeValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?non-empty-string $type
     */
    public static function validate(
        ReflectionProperty $property,
        ?string $type,
    ): void {
        if ($type === '') {
            throw MappingException::emptyType(
                $property->class,
                $property->name,
            );
        }
    }
}
