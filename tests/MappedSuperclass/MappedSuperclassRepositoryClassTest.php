<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\MappedSuperclass;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\AnonymousRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\EmptyRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepository;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\InvalidRepository;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\InvalidRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\NonExistingRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\UndefinedRepositoryClass;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class MappedSuperclassRepositoryClassTest extends TestCase
{
    public function testUndefinedRepositoryClass(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedRepositoryClass::class);

        self::assertSame(UndefinedRepositoryClass::class, $metadata->getName());
        self::assertMappedSuperclass($metadata);
        self::assertNull($metadata->customRepositoryClassName);
    }

    public function testExistingRepositoryClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingRepositoryClass::class);

        self::assertSame(ExistingRepositoryClass::class, $metadata->getName());
        self::assertMappedSuperclass($metadata);
        self::assertSame(ExistingRepository::class, $metadata->customRepositoryClassName);
    }

    public function testNonExistingRepositoryClass(): void
    {
        $this->expectException(MappingException::classNotFound('NonExistingRepository'));

        $this->loadClassMetadata(NonExistingRepositoryClass::class);
    }

    public function testEmptyRepositoryClass(): void
    {
        $this->expectException(MappingException::emptyClassName());

        $this->loadClassMetadata(EmptyRepositoryClass::class);
    }

    public function testAnonymousRepositoryClass(): void
    {
        $this->expectException(MappingException::class);

        $this->loadClassMetadata(AnonymousRepositoryClass::class);
    }

    public function testInvalidRepositoryClass(): void
    {
        $this->expectException(MappingException::invalidRepositoryClass(InvalidRepository::class));

        $this->loadClassMetadata(InvalidRepositoryClass::class);
    }
}
