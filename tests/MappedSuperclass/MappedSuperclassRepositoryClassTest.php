<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\MappedSuperclass;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\AnonymousRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\EmptyRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepository;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepositoryClass;
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
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingRepositoryClass.orm.php': Class 'NonExistingRepository' does not exist");

        $this->loadClassMetadata(NonExistingRepositoryClass::class);
    }

    public function testEmptyRepositoryClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyRepositoryClass.orm.php': Class name cannot be empty");

        $this->loadClassMetadata(EmptyRepositoryClass::class);
    }

    public function testAnonymousRepositoryClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessageMatches("/Invalid file 'AnonymousRepositoryClass.orm.php': Class 'class@anonymous[^']*' is anonymous/");

        $this->loadClassMetadata(AnonymousRepositoryClass::class);
    }

    public function testInvalidRepositoryClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidRepositoryClass.orm.php': Class 'InvalidRepository' is not a valid repository class because does not extend '".EntityRepository::class."'");

        $this->loadClassMetadata(InvalidRepositoryClass::class);
    }
}
