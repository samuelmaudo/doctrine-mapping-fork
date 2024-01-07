<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class MappedSuperclassRepositoryClassTest extends TestCase
{
    public function testUndefinedRepositoryClass(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedRepositoryClass::class, __DIR__);

        self::assertSame(UndefinedRepositoryClass::class, $metadata->getName());
        self::assertTrue($metadata->isMappedSuperclass);
        self::assertNull($metadata->customRepositoryClassName);
    }

    public function testExistingRepositoryClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingRepositoryClass::class, __DIR__);

        self::assertSame(ExistingRepositoryClass::class, $metadata->getName());
        self::assertTrue($metadata->isMappedSuperclass);
        self::assertSame(ExistingRepository::class, $metadata->customRepositoryClassName);
    }

    public function testNonExistingRepositoryClass(): void
    {
        self::assertException(
            MappingException::classNotFound('NonExistingRepository'),
            fn () => $this->loadClassMetadata(NonExistingRepositoryClass::class, __DIR__),
        );
    }

    public function testEmptyRepositoryClass(): void
    {
        self::assertException(
            MappingException::emptyClassName(),
            fn () => $this->loadClassMetadata(EmptyRepositoryClass::class, __DIR__),
        );
    }

    public function testAnonymousRepositoryClass(): void
    {
        self::assertException(
            MappingException::class,
            fn () => $this->loadClassMetadata(AnonymousRepositoryClass::class, __DIR__),
        );
    }

    public function testInvalidRepositoryClass(): void
    {
        self::assertException(
            MappingException::invalidRepositoryClass(InvalidRepository::class),
            fn () => $this->loadClassMetadata(InvalidRepositoryClass::class, __DIR__),
        );
    }
}
