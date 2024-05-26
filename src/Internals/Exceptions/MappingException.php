<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Exceptions;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Throwable;

final class MappingException extends DoctrineMappingException
{
    use AssociationExceptions;
    use ColumnExceptions;
    use CustomIdGeneratorExceptions;
    use EmbeddableExceptions;
    use FieldExceptions;
    use IndexExceptions;
    use SequenceGeneratorExceptions;
    use TableExceptions;
    use UniqueConstraintExceptions;

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

    public static function metadataNotFound(string $className): self
    {
        return new self("Metadata for class '{$className}' not found");
    }

    public static function emptyClassName(): self
    {
        return new self('Class name cannot be empty');
    }

    public static function classNotFound(string $className): self
    {
        return new self("Class '{$className}' does not exist");
    }

    public static function anonymousClass(string $className): self
    {
        return new self("Class '{$className}' is anonymous");
    }

    public static function invalidRepositoryClass(string $className): self
    {
        $entityRepositoryClass = EntityRepository::class;

        return new self("Class '{$className}' is not a valid repository class because does not extend '{$entityRepositoryClass}'");
    }
    public static function emptyPropertyName(): self
    {
        return new self("Property name cannot be empty");
    }

    public static function propertyNotFound(string $className, string $propertyName): self
    {
        return new self("Class '{$className}' has no property '{$propertyName}'");
    }

    public static function duplicateProperty(string $className, string $propertyName): self
    {
        return new self("Already mapped property '{$propertyName}' on class '{$className}'");
    }

    public static function missingClassAttribute(string $className, string $propertyName): self
    {
        return new self("Missing class attribute for property '{$propertyName}' on class '{$className}'");
    }

    public static function missingTargetEntity(string $className, string $propertyName): self
    {
        return new self("Missing target entity for property '{$propertyName}' on class '{$className}'");
    }
}
