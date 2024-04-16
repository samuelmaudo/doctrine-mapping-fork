<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait ColumnExceptions
{
    public static function emptyColumnName(string $fieldName): self
    {
        return new self("Empty column name for field '{$fieldName}'");
    }

    public static function emptyColumnDefinition(string $fieldName): self
    {
        return new self("Empty column definition for field '{$fieldName}'");
    }

    public static function nullableId(string $fieldName): self
    {
        return new self("Nullable column for ID '{$fieldName}'");
    }

    public static function nonPositiveLength(string $fieldName): self
    {
        return new self("Negative or zero length for field '{$fieldName}'");
    }

    public static function nonPositivePrecision(string $fieldName): self
    {
        return new self("Negative or zero precision for field '{$fieldName}'");
    }

    public static function missingPrecision(string $fieldName): self
    {
        return new self("Missing precision for field '{$fieldName}'");
    }

    public static function nonPositiveScale(string $fieldName): self
    {
        return new self("Negative or zero scale for field '{$fieldName}'");
    }

    public static function scaleGreaterThanPrecision(string $fieldName): self
    {
        return new self("Scale for field '{$fieldName}' is greater than precision");
    }

    public static function emptyCharset(string $fieldName): self
    {
        return new self("Empty charset for field '{$fieldName}'");
    }

    public static function emptyCollation(string $fieldName): self
    {
        return new self("Empty collation for field '{$fieldName}'");
    }
}
