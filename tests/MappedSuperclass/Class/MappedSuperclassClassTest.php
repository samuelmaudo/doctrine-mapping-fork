<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\MappedSuperclass\Class;

use Doctrine\Persistence\Mapping\MappingException as PersistenceMappingException;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class MappedSuperclassClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingClass::class, __DIR__);

        self::assertSame(ExistingClass::class, $metadata->getName());
        self::assertTrue($metadata->isMappedSuperclass);
    }

    public function testMistakenClass(): void
    {
        self::assertException(
            PersistenceMappingException::invalidMappingFile(MistakenClass::class, 'MistakenClass.orm.php'),
            fn () => $this->loadClassMetadata(MistakenClass::class, __DIR__),
        );
    }

    public function testNonExistingClass(): void
    {
        self::assertException(
            MappingException::classNotFound('NonExisting'),
            fn () => $this->loadClassMetadata(NonExistingClass::class, __DIR__),
        );
    }

    public function testEmptyClass(): void
    {
        self::assertException(
            MappingException::emptyClassName(),
            fn () => $this->loadClassMetadata(EmptyClass::class, __DIR__),
        );
    }

    public function testAnonymousClass(): void
    {
        self::assertException(
            MappingException::class,
            fn () => $this->loadClassMetadata(AnonymousClass::class, __DIR__),
        );
    }
}
