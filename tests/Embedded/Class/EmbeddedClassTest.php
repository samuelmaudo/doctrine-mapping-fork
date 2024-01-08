<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\Class;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class EmbeddedClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $metadata = $this->loadClassMetadata(ExistingClass::class, __DIR__);

        self::assertSame(ExistingClass::class, $metadata->getName());

        self::assertArrayHasKey('id', $metadata->embeddedClasses);
        self::assertSame(ExistingId::class, $metadata->embeddedClasses['id']['class']);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
        self::assertSame(ExistingField::class, $metadata->embeddedClasses['field']['class']);
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

    public function testUndefinedClass(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedClass::class, __DIR__);

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
            fn () => $this->loadClassMetadata(MissingClass::class, __DIR__),
        );
    }
}
