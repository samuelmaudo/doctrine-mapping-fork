<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entity;

use Doctrine\Persistence\Mapping\MappingException as PersistenceMappingException;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Entity\Class\AnonymousClass;
use Hereldar\DoctrineMapping\Tests\Entity\Class\EmptyClass;
use Hereldar\DoctrineMapping\Tests\Entity\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\Entity\Class\MistakenClass;
use Hereldar\DoctrineMapping\Tests\Entity\Class\NonExistingClass;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class EntityClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingClass::class);

        self::assertSame(ExistingClass::class, $metadata->getName());
        self::assertEntity($metadata);
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
        self::assertException(
            MappingException::classNotFound('NonExisting'),
            fn () => $this->loadClassMetadata(NonExistingClass::class),
        );
    }

    public function testEmptyClass(): void
    {
        self::assertException(
            MappingException::emptyClassName(),
            fn () => $this->loadClassMetadata(EmptyClass::class),
        );
    }

    public function testAnonymousClass(): void
    {
        self::assertException(
            MappingException::class,
            fn () => $this->loadClassMetadata(AnonymousClass::class),
        );
    }
}
