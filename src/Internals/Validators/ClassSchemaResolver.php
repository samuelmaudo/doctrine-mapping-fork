<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;

/**
 * @internal
 */
final class ClassSchemaResolver
{
    /**
     * @throws MappingException
     * @psalm-assert ?non-empty-string $schema
     */
    public static function validate(
        ReflectionClass $class,
        ?string $schema,
    ): void {
        if ($schema === '') {
            throw MappingException::emptySchema($class->name);
        }
    }
}
