<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Composer\InstalledVersions;
use Composer\Semver\VersionParser;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\EmbeddedClassMapping;
use Doctrine\ORM\Mapping\FieldMapping;
use Doctrine\ORM\Mapping\MappingException as OrmMappingException;
use Doctrine\ORM\Mapping\NamingStrategy;
use Doctrine\ORM\Mapping\TypedFieldMapper;
use Doctrine\Persistence\Mapping\MappingException as PersistenceMappingException;
use Doctrine\Persistence\Mapping\RuntimeReflectionService;
use Hereldar\DoctrineMapping\Drivers\PhpDriver;
use Hereldar\DoctrineMapping\Drivers\SimplifiedPhpDriver;
use PHPUnit\Framework\Constraint\Exception as ExceptionConstraint;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\Constraint\ExceptionMessage;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Throwable;

abstract class TestCase extends PHPUnitTestCase
{
    /** @var array<string, bool> */
    private static array $constraintsCache = [];

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertEntity(ClassMetadata $metadata): void
    {
        self::assertFalse($metadata->isMappedSuperclass);
        self::assertFalse($metadata->isEmbeddedClass);
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertMappedSuperclass(ClassMetadata $metadata): void
    {
        self::assertTrue($metadata->isMappedSuperclass);
        self::assertFalse($metadata->isEmbeddedClass);
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertEmbeddable(ClassMetadata $metadata): void
    {
        self::assertFalse($metadata->isMappedSuperclass);
        self::assertTrue($metadata->isEmbeddedClass);
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertField(
        ClassMetadata $metadata,
        string $field,
    ): void {
        self::assertArrayHasKey($field, $metadata->fieldMappings);

        $fieldMapping = $metadata->fieldMappings[$field];

        if (self::doctrineOrmVersionSatisfies('>=3.0')) {
            self::assertInstanceOf(FieldMapping::class, $fieldMapping);
        } else {
            self::assertIsArray($fieldMapping);
        }
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldColumnDefinition(
        ClassMetadata $metadata,
        string $field,
        ?string $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->columnDefinition
                : $fieldMapping['columnDefinition']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldColumnName(
        ClassMetadata $metadata,
        string $field,
        string $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->columnName
                : $fieldMapping['columnName']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldGenerated(
        ClassMetadata $metadata,
        string $field,
        ?int $value
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        if (null === $value) {
            self::assertFalse(
                (self::doctrineOrmVersionSatisfies('>=3.0'))
                    ? isset($fieldMapping->generated)
                    : isset($fieldMapping['generated'])
            );
        } else {
            self::assertSame(
                $value,
                (self::doctrineOrmVersionSatisfies('>=3.0'))
                    ? $fieldMapping->generated
                    : $fieldMapping['generated']
            );
        }
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldName(
        ClassMetadata $metadata,
        string $field,
        string $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->fieldName
                : $fieldMapping['fieldName']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldId(
        ClassMetadata $metadata,
        string $field,
        ?bool $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->id
                : $fieldMapping['id']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldLength(
        ClassMetadata $metadata,
        string $field,
        ?int $value
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->length
                : $fieldMapping['length']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldNotInsertable(
        ClassMetadata $metadata,
        string $field,
        ?bool $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->notInsertable
                : $fieldMapping['notInsertable']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldNotUpdatable(
        ClassMetadata $metadata,
        string $field,
        ?bool $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->notUpdatable
                : $fieldMapping['notUpdatable']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldNullable(
        ClassMetadata $metadata,
        string $field,
        ?bool $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->nullable
                : $fieldMapping['nullable']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldOption(
        ClassMetadata $metadata,
        string $field,
        string $key,
        mixed $value,
    ): void {
        self::assertField($metadata, $field);

        /** @var array<string, mixed>|null $fieldMappingOptions */
        $fieldMappingOptions = (self::doctrineOrmVersionSatisfies('>=3.0'))
            ? $metadata->fieldMappings[$field]->options
            : $metadata->fieldMappings[$field]['options'];

        self::assertIsArray($fieldMappingOptions);
        self::assertArrayHasKey($key, $fieldMappingOptions);
        self::assertSame($value, $fieldMappingOptions[$key]);
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldPrecision(
        ClassMetadata $metadata,
        string $field,
        ?int $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->precision
                : $fieldMapping['precision']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldScale(
        ClassMetadata $metadata,
        string $field,
        ?int $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->scale
                : $fieldMapping['scale']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldType(
        ClassMetadata $metadata,
        string $field,
        string $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $fieldMapping->type
                : $fieldMapping['type']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertFieldUnique(
        ClassMetadata $metadata,
        string $field,
        ?bool $value,
    ): void {
        self::assertField($metadata, $field);

        $fieldMapping = $metadata->fieldMappings[$field];

        self::assertSame($value, (self::doctrineOrmVersionSatisfies('>=3.0'))
            ? $fieldMapping->unique
            : $fieldMapping['unique']);
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertEmbedded(
        ClassMetadata $metadata,
        string $embedded,
    ): void {
        self::assertArrayHasKey($embedded, $metadata->embeddedClasses);

        $embeddedClass = $metadata->embeddedClasses[$embedded];

        if (self::doctrineOrmVersionSatisfies('>=3.0')) {
            self::assertInstanceOf(EmbeddedClassMapping::class, $embeddedClass);
        } else {
            self::assertIsArray($embeddedClass);
        }
    }

    /**
     * @param ClassMetadata<object> $metadata
     * @param class-string $value
     */
    public static function assertEmbeddedClass(
        ClassMetadata $metadata,
        string $embedded,
        string $value,
    ): void {
        self::assertEmbedded($metadata, $embedded);

        $embeddedClass = $metadata->embeddedClasses[$embedded];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $embeddedClass->class
                : $embeddedClass['class']
        );
    }

    /**
     * @param ClassMetadata<object> $metadata
     */
    public static function assertEmbeddedColumnPrefix(
        ClassMetadata $metadata,
        string $embedded,
        string|false|null $value,
    ): void {
        self::assertEmbedded($metadata, $embedded);

        $embeddedClass = $metadata->embeddedClasses[$embedded];

        self::assertSame(
            $value,
            (self::doctrineOrmVersionSatisfies('>=3.0'))
                ? $embeddedClass->columnPrefix
                : $embeddedClass['columnPrefix']
        );
    }

    /**
     * @param Throwable|class-string<Throwable> $expectedException
     *
     * @psalm-suppress InternalClass
     * @psalm-suppress InternalMethod
     */
    public static function assertException(
        Throwable|string $expectedException,
        callable $callback,
    ): void {
        $exception = null;

        try {
            $callback();
        } catch (Throwable $exception) {
        }

        if (\is_string($expectedException)) {
            static::assertThat(
                $exception,
                new ExceptionConstraint($expectedException),
            );
        } else {
            static::assertThat(
                $exception,
                new ExceptionConstraint($expectedException::class),
            );
            static::assertThat(
                $exception,
                new ExceptionMessage($expectedException->getMessage()),
            );
            static::assertThat(
                $exception,
                new ExceptionCode($expectedException->getCode()),
            );
        }
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $className
     *
     * @return ClassMetadata<T>
     *
     * @throws OrmMappingException
     * @throws PersistenceMappingException
     */
    protected function loadClassMetadata(
        string $className,
        ?string $directory = null,
        ?string $namespace = null,
    ): ClassMetadata {
        $directory ??= $this->getMetadataDirectory();
        $namespace ??= $this->getClassNamespace($className);

        $driver = $this->makeSimplifiedDriver($directory, $namespace);
        $metadata = $this->makeClassMetadata($className);

        $driver->loadMetadataForClass($className, $metadata);

        return $metadata;
    }

    private function getMetadataDirectory(): string
    {
        $className = $this::class;

        /** @var positive-int $lastBackslash */
        $lastBackslash = \strrpos($className, '\\');
        $classShortName = \substr($className, $lastBackslash + 1);
        $namespace = \substr($className, 0, $lastBackslash);

        /** @var positive-int $secondLastBackslash */
        $secondLastBackslash = \strrpos($namespace, '\\', -1);
        $directory = \substr($namespace, $secondLastBackslash + 1);
        $subdirectory = \substr($classShortName, \strlen($directory), -4);

        return __DIR__."/{$directory}/{$subdirectory}";
    }

    private function getClassNamespace(string $className): string
    {
        /** @var positive-int $lastBackslash */
        $lastBackslash = \strrpos($className, '\\');

        return \substr($className, 0, $lastBackslash);
    }

    /**
     * @phpstan-ignore method.unused
     */
    private function makeDriver(
        string $directory,
        string $fileExtension = PhpDriver::DEFAULT_FILE_EXTENSION,
    ): PhpDriver {
        return new PhpDriver($directory, $fileExtension);
    }

    private function makeSimplifiedDriver(
        string $directory,
        string $namespace,
        string $fileExtension = SimplifiedPhpDriver::DEFAULT_FILE_EXTENSION,
    ): SimplifiedPhpDriver {
        return new SimplifiedPhpDriver([$directory => $namespace], $fileExtension);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $className
     *
     * @return ClassMetadata<T>
     */
    private function makeClassMetadata(
        string $className,
        ?NamingStrategy $namingStrategy = null,
        ?TypedFieldMapper $typedFieldMapper = null,
    ): ClassMetadata {
        $metadata = new ClassMetadata($className, $namingStrategy, $typedFieldMapper);
        $metadata->initializeReflection(new RuntimeReflectionService());

        return $metadata;
    }

    private static function doctrineOrmVersionSatisfies(string $constraint): bool
    {
        if (isset(self::$constraintsCache[$constraint])) {
            return self::$constraintsCache[$constraint];
        }

        $result = InstalledVersions::satisfies(new VersionParser(), 'doctrine/orm', $constraint);

        return self::$constraintsCache[$constraint] = $result;
    }
}
