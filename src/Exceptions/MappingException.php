<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Exceptions;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;

final class MappingException extends DoctrineMappingException
{
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
    public static function propertyTypeNotFound(string $className, string $propertyName): self
    {
        return new self("Type could not be found for property '{$propertyName}' on class '{$className}'");
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
    public static function nonPositiveScale(string $className, string $propertyName): self
    {
        return new self("Scale for property '{$propertyName}' on class '{$className}' is negative or zero");
    }
}
