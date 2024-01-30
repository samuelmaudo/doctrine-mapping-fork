<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\MappedSuperclass;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\Class\AnonymousClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\Class\EmptyClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\Class\MistakenClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\Class\NonExistingClass;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class MappedSuperclassClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingClass::class);

        self::assertSame(ExistingClass::class, $metadata->getName());
        self::assertMappedSuperclass($metadata);
    }

    public function testMistakenClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'MistakenClass.orm.php': Metadata for class '".MistakenClass::class."' not found");

        $this->loadClassMetadata(MistakenClass::class);
    }

    public function testNonExistingClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingClass.orm.php': Class 'NonExisting' does not exist");

        $this->loadClassMetadata(NonExistingClass::class);
    }

    public function testEmptyClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyClass.orm.php': Class name cannot be empty");

        $this->loadClassMetadata(EmptyClass::class);
    }

    public function testAnonymousClass(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessageMatches("/Invalid file 'AnonymousClass.orm.php': Class 'class@anonymous[^']*' is anonymous/");

        $this->loadClassMetadata(AnonymousClass::class);
    }
}
