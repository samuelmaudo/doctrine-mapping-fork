<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyCommentValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?non-empty-string $comment
     */
    public static function validate(
        ReflectionProperty $property,
        ?string $comment,
    ): void {
        if ($comment === '') {
            throw MappingException::emptyComment(
                $property->class,
                $property->name,
            );
        }
    }
}
