<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

trait TableExceptions
{
    public static function emptyTableName(string $className): self
    {
        return new self("Empty table name for class '{$className}'");
    }

    public static function emptySchemaName(string $className): self
    {
        return new self("Empty schema name for class '{$className}'");
    }

    public static function invalidTableOption(string $className, mixed $optionKey): self
    {
        $optionKeyRepresentation = \var_export($optionKey, true);

        return new self("Option keys for class '{$className}' should be non-empty strings, but {$optionKeyRepresentation} was found.");
    }
}
