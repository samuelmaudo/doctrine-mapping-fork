<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyCharsetValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?non-empty-string $charset
     */
    public static function validate(
        ReflectionProperty $property,
        ?string $charset,
    ): void {
        if ($charset === '') {
            throw MappingException::emptyCharset(
                $property->class,
                $property->name,
            );
        }
    }
}
