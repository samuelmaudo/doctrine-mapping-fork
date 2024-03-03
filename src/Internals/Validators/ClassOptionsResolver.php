<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;

/**
 * @internal
 */
final class ClassOptionsResolver
{
    /**
     * @throws MappingException
     * @psalm-assert ?non-empty-array<non-empty-string,mixed> $options
     */
    public static function validate(
        ReflectionClass $class,
        ?array $options,
    ): void {
        if (!$options) {
            return;
        }

        foreach ($options as $key => $value) {
            if (!is_string($key) || $key === '') {
                throw MappingException::invalidTableOption(
                    $class->name,
                    $key,
                );
            }
        }
    }
}
