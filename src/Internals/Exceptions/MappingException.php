<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Throwable;

final class MappingException extends DoctrineMappingException
{
    public static function invalidFile(string $fileName, Throwable $exception): self
    {
        $fileShortName = basename($fileName);

        return new self(
            "Invalid file '{$fileShortName}': {$exception->getMessage()}",
            previous: $exception,
        );
    }

    public static function invalidMetadata(string $className, Throwable $exception): self
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

        return new self("Class '{$className}' is not a valid repository class because does not extend '{$entityRepositoryClass}'");
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

    public static function emptyPropertyName(): self
    {
        return new self("Property name cannot be empty");
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
    public static function duplicateProperty(string $className, string $propertyName): self
    {
        return new self("Already mapped property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param class-string $className
     * @param non-empty-string $propertyName
     */
    public static function missingClassAttribute(string $className, string $propertyName): self
    {
        return new self("Missing class attribute for property '{$propertyName}' on class '{$className}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function emptyColumnName(string $fieldName): self
    {
        return new self("Empty column name for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function emptyColumnDefinition(string $fieldName): self
    {
        return new self("Empty column definition for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function emptyType(string $fieldName): self
    {
        return new self("Empty type for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function emptyEnumType(string $fieldName): self
    {
        return new self("Empty enum type for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function nullableId(string $fieldName): self
    {
        return new self("Nullable ID for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function invalidGenerationMode(string $fieldName, int|string $value): self
    {
        return new self("Invalid generation mode '{$value}' for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function invalidGenerationStrategy(string $fieldName, int|string $value): self
    {
        return new self("Invalid generation strategy '{$value}' for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function nonPositiveLength(string $fieldName): self
    {
        return new self("Negative or zero length for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function nonPositivePrecision(string $fieldName): self
    {
        return new self("Negative or zero precision for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function missingPrecision(string $fieldName): self
    {
        return new self("Missing precision for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function nonPositiveScale(string $fieldName): self
    {
        return new self("Negative or zero scale for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function scaleGreaterThanPrecision(string $fieldName): self
    {
        return new self("Scale for field '{$fieldName}' is greater than precision");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function emptyCharset(string $fieldName): self
    {
        return new self("Empty charset for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function emptyCollation(string $fieldName): self
    {
        return new self("Empty collation for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function emptySequenceName(string $fieldName): self
    {
        return new self("Empty sequence name for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function nonPositiveAllocationSize(string $fieldName): self
    {
        return new self("Negative or zero allocation size for field '{$fieldName}'");
    }

    /**
     * @param non-empty-string $fieldName
     */
    public static function nonPositiveInitialValue(string $fieldName): self
    {
        return new self("Negative or zero initial value for field '{$fieldName}'");
    }

    /**
     * @param class-string $className
     */
    public static function invalidCustomIdGenerator(string $className): self
    {
        $abstractIdGeneratorClass = AbstractIdGenerator::class;

        return new self("Class '{$className}' is not a valid custom ID generator because does not extend '{$abstractIdGeneratorClass}'");
    }

    /**
     * @param non-empty-string $entityName
     * @param non-empty-string $indexName
     */
    public static function duplicateIndexName(string $entityName, string $indexName): self
    {
        return new self("An index with the name '{$indexName}' already exists for the entity '{$entityName}'");
    }

    /**
     * @param ?non-empty-string $indexName
     */
    public static function invalidIndexConfiguration(?string $indexName): self
    {
        return new self((null === $indexName)
            ? "Indexes should contain fields or columns, but not both"
            : "Index '{$indexName}' should contain fields or columns, but not both");
    }

    /**
     * @param ?non-empty-string $indexName
     */
    public static function invalidIndexField(?string $indexName, mixed $field): self
    {
        $fieldRepresentation = var_export($field, true);

        return new self((null === $indexName)
            ? "Field list of indexes should contain non-empty strings, but {$fieldRepresentation} was found"
            : "Field list of index '{$indexName}' should contain non-empty strings, but {$fieldRepresentation} was found");
    }

    /**
     * @param ?non-empty-string $indexName
     */
    public static function invalidIndexColumn(?string $indexName, mixed $column): self
    {
        $columnRepresentation = var_export($column, true);

        return new self((null === $indexName)
            ? "Column list of indexes should contain non-empty strings, but {$columnRepresentation} was found"
            : "Column list of index '{$indexName}' should contain non-empty strings, but {$columnRepresentation} was found");
    }

    /**
     * @param ?non-empty-string $indexName
     */
    public static function invalidIndexFlag(?string $indexName, mixed $flag): self
    {
        $flagRepresentation = var_export($flag, true);

        return new self((null === $indexName)
            ? "Flag list of indexes should contain non-empty strings, but {$flagRepresentation} was found"
            : "Flag list of index '{$indexName}' should contain non-empty strings, but {$flagRepresentation} was found");
    }

    /**
     * @param ?non-empty-string $indexName
     */
    public static function invalidIndexOption(?string $indexName, mixed $optionKey): self
    {
        $optionKeyRepresentation = var_export($optionKey, true);

        return new self((null === $indexName)
            ? "Option keys of indexes should be non-empty strings, but {$optionKeyRepresentation} was found"
            : "Option keys of index '{$indexName}' should be non-empty strings, but {$optionKeyRepresentation} was found");
    }

    /**
     * @param non-empty-string $entityName
     * @param non-empty-string $constraintName
     */
    public static function duplicateUniqueConstraintName(string $entityName, string $constraintName): self
    {
        return new self("A unique constraint with the name '{$constraintName}' already exists for the entity '{$entityName}'");
    }

    /**
     * @param ?non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintConfiguration(?string $constraintName): self
    {
        return new self((null === $constraintName)
            ? "Unique constraints should contain fields or columns, but not both"
            : "Unique constraint '{$constraintName}' should contain fields or columns, but not both");
    }

    /**
     * @param ?non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintField(?string $constraintName, mixed $field): self
    {
        $fieldRepresentation = var_export($field, true);

        return new self((null === $constraintName)
            ? "Field list of unique constraints should contain non-empty strings, but {$fieldRepresentation} was found"
            : "Field list of unique constraint '{$constraintName}' should contain non-empty strings, but {$fieldRepresentation} was found");
    }

    /**
     * @param ?non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintColumn(?string $constraintName, mixed $column): self
    {
        $columnRepresentation = var_export($column, true);

        return new self((null === $constraintName)
            ? "Column list of unique constraints should contain non-empty strings, but {$columnRepresentation} was found"
            : "Column list of unique constraint '{$constraintName}' should contain non-empty strings, but {$columnRepresentation} was found");
    }

    /**
     * @param ?non-empty-string $constraintName
     */
    public static function invalidUniqueConstraintOption(?string $constraintName, mixed $optionKey): self
    {
        $optionKeyRepresentation = var_export($optionKey, true);

        return new self((null === $constraintName)
            ? "Option keys of unique constraints should be non-empty strings, but {$optionKeyRepresentation} was found"
            : "Option keys of unique constraint '{$constraintName}' should be non-empty strings, but {$optionKeyRepresentation} was found");
    }
}
