<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait UniqueConstraintExceptions
{
    public static function duplicateUniqueConstraintName(string $entityName, string $constraintName): self
    {
        return new self("A unique constraint with the name '{$constraintName}' already exists for the entity '{$entityName}'");
    }

    public static function invalidUniqueConstraintConfiguration(?string $constraintName): self
    {
        return new self((null === $constraintName)
            ? "Unique constraints should contain fields or columns, but not both"
            : "Unique constraint '{$constraintName}' should contain fields or columns, but not both");
    }

    public static function invalidUniqueConstraintField(?string $constraintName, mixed $field): self
    {
        $fieldRepresentation = var_export($field, true);

        return new self((null === $constraintName)
            ? "Field list of unique constraints should contain non-empty strings, but {$fieldRepresentation} was found"
            : "Field list of unique constraint '{$constraintName}' should contain non-empty strings, but {$fieldRepresentation} was found");
    }

    public static function invalidUniqueConstraintColumn(?string $constraintName, mixed $column): self
    {
        $columnRepresentation = var_export($column, true);

        return new self((null === $constraintName)
            ? "Column list of unique constraints should contain non-empty strings, but {$columnRepresentation} was found"
            : "Column list of unique constraint '{$constraintName}' should contain non-empty strings, but {$columnRepresentation} was found");
    }

    public static function invalidUniqueConstraintOption(?string $constraintName, mixed $optionKey): self
    {
        $optionKeyRepresentation = var_export($optionKey, true);

        return new self((null === $constraintName)
            ? "Option keys of unique constraints should be non-empty strings, but {$optionKeyRepresentation} was found"
            : "Option keys of unique constraint '{$constraintName}' should be non-empty strings, but {$optionKeyRepresentation} was found");
    }
}
