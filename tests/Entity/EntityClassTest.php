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
        $this->expectException(
            PersistenceMappingException::invalidMappingFile(
                MistakenClass::class,
                'MistakenClass.orm.php',
            )
        );

        $this->loadClassMetadata(MistakenClass::class);
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
