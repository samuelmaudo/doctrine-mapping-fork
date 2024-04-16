<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait FieldExceptions
{
    public static function emptyType(string $fieldName): self
    {
        return new self("Empty type for field '{$fieldName}'");
    }

    public static function emptyEnumType(string $fieldName): self
    {
        return new self("Empty enum type for field '{$fieldName}'");
    }

    public static function invalidGenerationMode(string $fieldName, int|string $value): self
    {
        return new self("Invalid generation mode '{$value}' for field '{$fieldName}'");
    }

    public static function invalidGenerationStrategy(string $fieldName, int|string $value): self
    {
        return new self("Invalid generation strategy '{$value}' for field '{$fieldName}'");
    }
}
