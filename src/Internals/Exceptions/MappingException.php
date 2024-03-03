<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;

final class MappingException extends DoctrineMappingException
{
    public static function invalidFile(string $fileName, \Throwable $exception): self
    {
        $fileShortName = basename($fileName);

        return new self(
            "Invalid file '{$fileShortName}': {$exception->getMessage()}",
            previous: $exception,
        );
    }

    public static function invalidMetadata(string $className, \Throwable $exception): self
    {
        $classShortName = substr($className, strrpos($className, '\\') + 1);

        return new self(
            "Invalid metadata for class '{$classShortName}': {$exception->getMessage()}",
            previous: $exception,
        );
    }

    /**
     * @param non-empty-string $className
     */
    public static function metadataNotFound(string $className): self
    {
        return new self("Metadata for class '{$className}' not found");
    }

    public static function emptyClassName(): self
    {
        return new self('Class name cannot be empty');
    }

    /**
     * @param non-empty-string $className
     */
    public static function classNotFound(string $className): self
    {
        return new self("Class '{$className}' does not exist");
    }

    /**
     * @param class-string $className
     */
    public static function anonymousClass(string $className): self
    {
        return new self("Class '{$className}' is anonymous");
    }

    /**
     * @param class-string $className
     */
    public static function invalidRepositoryClass(string $className): self
    {
        $entityRepositoryClass = EntityRepository::class;

        return new self("Class '{$className}' is not a valid repository class because does not extend {$entityRepositoryClass}.");
    }

    /**
     * @param class-string $className
     */
    public static function emptyTable(string $className): self
    {
        return new self("Empty table for class '{$className}'");
    }

    /**
     * @param class-string $className
     */
    public static function emptySchema(string $className): self
    {
        return new self("Empty schema for class '{$className}'");
    }

    /**
     * @param class-string $className
     */
    public static function invalidTableOption(string $className, mixed $optionKey): self
    {
        $optionKeyRepresentation = var_export($optionKey, true);

        return new self("Option keys for class '{$className}' should be non-empty strings, but {$optionKeyRepresentation} was found.");
    }

    /**
     * @param class-string $className
     */
    public static function emptyPropertyName(string $className): self
    {
        return new self("Property name cannot be empty (class '{$className}')");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function propertyNotFound(string $className, string $propertyName): self
    {
        return new self("Class '{$className}' has no property '{$propertyName}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function missingClassAttribute(string $className, string $propertyName): self
    {
        return new self("Class attribute for property '{$propertyName}' on class '{$className}' is missing");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function emptyColumn(string $className, string $propertyName): self
    {
        return new self("Empty column for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function emptyColumnDefinition(string $className, string $propertyName): self
    {
        return new self("Empty column definition for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function emptyType(string $className, string $propertyName): self
    {
        return new self("Empty type for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function nullableId(string $className, string $propertyName): self
    {
        return new self("Nullable ID for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function invalidGenerationMode(string $className, string $propertyName, int|string $value): self
    {
        return new self("Invalid generation mode '{$value}' for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function invalidGenerationStrategy(string $className, string $propertyName, int|string $value): self
    {
        return new self("Invalid generation strategy '{$value}' for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function nonPositiveLength(string $className, string $propertyName): self
    {
        return new self("Length for property '{$propertyName}' on class '{$className}' is negative or zero");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function nonPositivePrecision(string $className, string $propertyName): self
    {
        return new self("Precision for property '{$propertyName}' on class '{$className}' is negative or zero");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function missingPrecision(string $className, string $propertyName): self
    {
        return new self("Precision for property '{$propertyName}' on class '{$className}' is missing");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function nonPositiveScale(string $className, string $propertyName): self
    {
        return new self("Scale for property '{$propertyName}' on class '{$className}' is negative or zero");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function scaleGreaterThanPrecision(string $className, string $propertyName): self
    {
        return new self("Scale for property '{$propertyName}' on class '{$className}' is greater than precision");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function emptyCharset(string $className, string $propertyName): self
    {
        return new self("Empty charset for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function emptyCollation(string $className, string $propertyName): self
    {
        return new self("Empty collation for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function emptySequenceName(string $className, string $propertyName): self
    {
        return new self("Empty sequence name for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function nonPositiveAllocationSize(string $className, string $propertyName): self
    {
        return new self("Allocation size for property '{$propertyName}' on class '{$className}' is negative or zero");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function nonPositiveInitialValue(string $className, string $propertyName): self
    {
        return new self("Initial value for property '{$propertyName}' on class '{$className}' is negative or zero");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $indexName
     */
    public static function invalidIndexConfiguration(string $className, string $indexName): self
    {
        return new self("Index '{$indexName}' for class '{$className}' should contain fields or columns, but not both");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $indexName
     */
    public static function invalidIndexField(string $className, string $indexName, mixed $field): self
    {
        $fieldRepresentation = var_export($field, true);

        return new self("Field list of index '{$indexName}' for class '{$className}' should contain non-empty strings, but {$fieldRepresentation} was found");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $indexName
     */
    public static function invalidIndexColumn(string $className, string $indexName, mixed $column): self
    {
        $columnRepresentation = var_export($column, true);

        return new self("Column list of index '{$indexName}' for class '{$className}' should contain non-empty strings, but {$columnRepresentation} was found");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $indexName
     */
    public static function invalidIndexFlag(string $className, string $indexName, mixed $flag): self
    {
        $flagRepresentation = var_export($flag, true);

        return new self("Flag list of index '{$indexName}' for class '{$className}' should contain non-empty strings, but {$flagRepresentation} was found");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $indexName
     */
    public static function invalidIndexOption(string $className, string $indexName, mixed $optionKey): self
    {
        $optionKeyRepresentation = var_export($optionKey, true);

        return new self("Option keys of index '{$indexName}' for class '{$className}' should be non-empty strings, but {$optionKeyRepresentation} was found.");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintConfiguration(string $className, string $constraintName): self
    {
        return new self("Unique constraint '{$constraintName}' for class '{$className}' should contain fields or columns, but not both");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintField(string $className, string $constraintName, mixed $field): self
    {
        $fieldRepresentation = var_export($field, true);

        return new self("Field list of unique constraint '{$constraintName}' for class '{$className}' should contain non-empty strings, but {$fieldRepresentation} was found");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintColumn(string $className, string $constraintName, mixed $column): self
    {
        $columnRepresentation = var_export($column, true);

        return new self("Column list of unique constraint '{$constraintName}' for class '{$className}' should contain non-empty strings, but {$columnRepresentation} was found");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintOption(string $className, string $constraintName, mixed $optionKey): self
    {
        $optionKeyRepresentation = var_export($optionKey, true);

        return new self("Option keys of unique constraint '{$constraintName}' for class '{$className}' should be non-empty strings, but {$optionKeyRepresentation} was found.");
    }
}
