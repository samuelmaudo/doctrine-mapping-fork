<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entity;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\AnonymousRepositoryClass;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\EmptyRepositoryClass;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\ExistingRepository;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\ExistingRepositoryClass;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\InvalidRepository;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\InvalidRepositoryClass;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\NonExistingRepositoryClass;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\UndefinedRepositoryClass;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class EntityRepositoryClassTest extends TestCase
{
    public function testUndefinedRepositoryClass(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedRepositoryClass::class);

        self::assertSame(UndefinedRepositoryClass::class, $metadata->getName());
        self::assertEntity($metadata);
        self::assertNull($metadata->customRepositoryClassName);
    }

    public function testExistingRepositoryClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingRepositoryClass::class);

        self::assertSame(ExistingRepositoryClass::class, $metadata->getName());
        self::assertEntity($metadata);
        self::assertSame(ExistingRepository::class, $metadata->customRepositoryClassName);
    }

    public function testNonExistingRepositoryClass(): void
    {
        self::assertException(
            MappingException::classNotFound('NonExistingRepository'),
            fn () => $this->loadClassMetadata(NonExistingRepositoryClass::class),
        );
    }

    public function testEmptyRepositoryClass(): void
    {
        self::assertException(
            MappingException::emptyClassName(),
            fn () => $this->loadClassMetadata(EmptyRepositoryClass::class),
        );
    }

    public function testAnonymousRepositoryClass(): void
    {
        self::assertException(
            MappingException::class,
            fn () => $this->loadClassMetadata(AnonymousRepositoryClass::class),
        );
    }

    public function testInvalidRepositoryClass(): void
    {
        self::assertException(
            MappingException::invalidRepositoryClass(InvalidRepository::class),
            fn () => $this->loadClassMetadata(InvalidRepositoryClass::class),
        );
    }
}
