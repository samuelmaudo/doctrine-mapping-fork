<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\MappingException as OrmMappingException;
use Doctrine\ORM\Mapping\NamingStrategy;
use Doctrine\ORM\Mapping\TypedFieldMapper;
use Doctrine\Persistence\Mapping\MappingException as PersistenceMappingException;
use Doctrine\Persistence\Mapping\RuntimeReflectionService;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Hereldar\DoctrineMapping\Drivers\PhpDriver;
use Hereldar\DoctrineMapping\Drivers\SimplifiedPhpDriver;
use PHPUnit\Framework\Constraint\Exception as ExceptionConstraint;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\Constraint\ExceptionMessage;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Throwable;

abstract class TestCase extends PHPUnitTestCase
{
    private ?FakerGenerator $fakerGenerator = null;

    public static function assertEntity(ClassMetadata $metadata): void
    {
        self::assertFalse($metadata->isMappedSuperclass);
        self::assertFalse($metadata->isEmbeddedClass);
    }

    public static function assertMappedSuperclass(ClassMetadata $metadata): void
    {
        self::assertTrue($metadata->isMappedSuperclass);
        self::assertFalse($metadata->isEmbeddedClass);
    }

    public static function assertEmbeddedClass(ClassMetadata $metadata): void
    {
        self::assertFalse($metadata->isMappedSuperclass);
        self::assertTrue($metadata->isEmbeddedClass);
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

    protected function makeDriver(
        string $directory,
        string $fileExtension = PhpDriver::DEFAULT_FILE_EXTENSION,
    ): PhpDriver {
        return new PhpDriver($directory, $fileExtension);
    }

    protected function makeSimplifiedDriver(
        string $directory,
        string $namespace,
        string $fileExtension = SimplifiedPhpDriver::DEFAULT_FILE_EXTENSION,
    ): SimplifiedPhpDriver {
        return new SimplifiedPhpDriver([$directory => $namespace], $fileExtension);
    }

    /**
     * @template T of object
     * @param class-string<T> $className
     * @return ClassMetadata<T>
     */
    protected function makeClassMetadata(
        string $className,
        ?NamingStrategy $namingStrategy = null,
        ?TypedFieldMapper $typedFieldMapper = null,
    ): ClassMetadata {
        $metadata = new ClassMetadata($className, $namingStrategy, $typedFieldMapper);
        $metadata->initializeReflection(new RuntimeReflectionService());
        return $metadata;
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $className
     *
     * @throws OrmMappingException
     * @throws PersistenceMappingException
     *
     * @return ClassMetadata<T>
     */
    protected function loadClassMetadata(
        string $className,
        string $directory,
        ?string $namespace = null,
    ): ClassMetadata {
        $namespace ??= substr($className, 0, strrpos($className, '\\'));

        $driver = $this->makeSimplifiedDriver($directory, $namespace);
        $metadata = $this->makeClassMetadata($className);

        $driver->loadMetadataForClass($className, $metadata);

        return $metadata;
    }

    protected function fake(): FakerGenerator
    {
        return $this->fakerGenerator ??= FakerFactory::create();
    }
}
