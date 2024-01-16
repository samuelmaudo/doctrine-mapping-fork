<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\MappedSuperclass;

use Doctrine\Persistence\Mapping\MappingException as PersistenceMappingException;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
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
        self::assertException(
            PersistenceMappingException::invalidMappingFile(MistakenClass::class, 'MistakenClass.orm.php'),
            fn () => $this->loadClassMetadata(MistakenClass::class),
        );
    }

    public function testNonExistingClass(): void
    {
        $this->expectException(MappingException::classNotFound('NonExisting'));

        $this->loadClassMetadata(NonExistingClass::class);
    }

    public function testEmptyClass(): void
    {
        $this->expectException(MappingException::emptyClassName());

        $this->loadClassMetadata(EmptyClass::class);
    }

    public function testAnonymousClass(): void
    {
        $this->expectException(MappingException::class);

        $this->loadClassMetadata(AnonymousClass::class);
    }
}
