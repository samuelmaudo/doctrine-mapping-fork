<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait AssociationExceptions
{
    public static function duplicateJoinColumnName(string $associationName, string $columnName): self
    {
        return new self("A join column with the name '{$columnName}' already exists for the association '{$associationName}'");
    }

    public static function invalidCascadeOption(string $associationName, string $optionValue): self
    {
        return new self("Invalid cascade option '{$optionValue}' for association '{$associationName}'");
    }

    public static function invalidFetchOption(string $associationName, string $optionValue): self
    {
        return new self("Invalid fetch option '{$optionValue}' for association '{$associationName}'");
    }

    public static function emptyInversedByAttribute(string $associationName): self
    {
        return new self("Empty inversed by attribute for association '{$associationName}'");
    }

    public static function invalidInversedByAttribute(string $targetEntity, string $propertyName): self
    {
        return new self("Target entity '{$targetEntity}' has no property '{$propertyName}'");
    }

    public static function emptyMappedByAttribute(string $associationName): self
    {
        return new self("Empty mapped by attribute for association '{$associationName}'");
    }

    public static function invalidMappedByAttribute(string $targetEntity, string $propertyName): self
    {
        return new self("Target entity '{$targetEntity}' has no property '{$propertyName}'");
    }

    public static function emptyIndexByAttribute(string $associationName): self
    {
        return new self("Empty index by attribute for association '{$associationName}'");
    }

    public static function invalidIndexByAttribute(string $targetEntity, string $propertyName): self
    {
        return new self("Target entity '{$targetEntity}' has no property '{$propertyName}'");
    }

    public static function emptyJoinColumName(?string $associationName): self
    {
        return new self((null === $associationName)
            ? "Empty join column name"
            : "Empty join column name for association '{$associationName}'");
    }

    public static function emptyJoinReferencedColumName(?string $associationName): self
    {
        return new self((null === $associationName)
            ? "Empty join referenced column name"
            : "Empty join referenced column name for association '{$associationName}'");
    }

    public static function emptyJoinColumnDefinition(?string $associationName): self
    {
        return new self((null === $associationName)
            ? "Empty join column definition"
            : "Empty join column definition for association '{$associationName}'");
    }

    public static function invalidJoinColumnOption(?string $associationName, mixed $optionKey): self
    {
        $optionKeyRepresentation = var_export($optionKey, true);

        return new self((null === $associationName)
            ? "Option keys of associations should be non-empty strings, but {$optionKeyRepresentation} was found"
            : "Option keys of association '{$associationName}' should be non-empty strings, but {$optionKeyRepresentation} was found");
    }
}
