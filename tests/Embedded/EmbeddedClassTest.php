<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\AnonymousClass;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\EmptyClass;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingField;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingId;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\MissingClass;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\NonExistingClass;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\UndefinedClass;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class EmbeddedClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingClass::class);

        self::assertSame(ExistingClass::class, $metadata->getName());

        self::assertArrayHasKey('id', $metadata->embeddedClasses);
        self::assertSame(ExistingId::class, $metadata->embeddedClasses['id']['class']);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
        self::assertSame(ExistingField::class, $metadata->embeddedClasses['field']['class']);
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

    public function testUndefinedClass(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedClass::class);

        self::assertSame(UndefinedClass::class, $metadata->getName());

        self::assertArrayHasKey('id', $metadata->embeddedClasses);
        self::assertSame(ExistingId::class, $metadata->embeddedClasses['id']['class']);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
        self::assertSame(ExistingField::class, $metadata->embeddedClasses['field']['class']);
    }

    public function testMissingClass(): void
    {
        self::assertException(
            MappingException::missingClassAttribute(MissingClass::class, 'id'),
            fn () => $this->loadClassMetadata(MissingClass::class),
        );
    }
}
