<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait IndexExceptions
{
    public static function duplicateIndexName(string $entityName, string $indexName): self
    {
        return new self("An index with the name '{$indexName}' already exists for the entity '{$entityName}'");
    }

    public static function invalidIndexConfiguration(?string $indexName): self
    {
        return new self((null === $indexName)
            ? 'Indexes should contain fields or columns, but not both'
            : "Index '{$indexName}' should contain fields or columns, but not both");
    }

    public static function invalidIndexField(?string $indexName, mixed $field): self
    {
        $fieldRepresentation = \var_export($field, true);

        return new self((null === $indexName)
            ? "Field list of indexes should contain non-empty strings, but {$fieldRepresentation} was found"
            : "Field list of index '{$indexName}' should contain non-empty strings, but {$fieldRepresentation} was found");
    }

    public static function invalidIndexColumn(?string $indexName, mixed $column): self
    {
        $columnRepresentation = \var_export($column, true);

        return new self((null === $indexName)
            ? "Column list of indexes should contain non-empty strings, but {$columnRepresentation} was found"
            : "Column list of index '{$indexName}' should contain non-empty strings, but {$columnRepresentation} was found");
    }

    public static function invalidIndexFlag(?string $indexName, mixed $flag): self
    {
        $flagRepresentation = \var_export($flag, true);

        return new self((null === $indexName)
            ? "Flag list of indexes should contain non-empty strings, but {$flagRepresentation} was found"
            : "Flag list of index '{$indexName}' should contain non-empty strings, but {$flagRepresentation} was found");
    }

    public static function invalidIndexOption(?string $indexName, mixed $optionKey): self
    {
        $optionKeyRepresentation = \var_export($optionKey, true);

        return new self((null === $indexName)
            ? "Option keys of indexes should be non-empty strings, but {$optionKeyRepresentation} was found"
            : "Option keys of index '{$indexName}' should be non-empty strings, but {$optionKeyRepresentation} was found");
    }
}
