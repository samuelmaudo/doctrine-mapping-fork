<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Exceptions;

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
    public static function nullablePrimaryKey(string $className, string $propertyName): self
    {
        return new self("Primary key '{$propertyName}' on class '{$className}' is nullable");
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
}
