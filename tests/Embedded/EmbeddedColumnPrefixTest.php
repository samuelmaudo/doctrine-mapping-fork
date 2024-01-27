<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbedded;
use Hereldar\DoctrineMapping\Internals\Resolvers\PropertyColumnPrefixResolver;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\DefinedColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\EmptyColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\FalseColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\UndefinedColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Entities\User;
use Hereldar\DoctrineMapping\Tests\Entities\UserId;
use Hereldar\DoctrineMapping\Tests\TestCase;
use ReflectionClass;
use TypeError;

final class EmbeddedColumnPrefixTest extends TestCase
{
    public function testDefinedColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumnPrefix::class);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
        self::assertSame('prefix_', $metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testUndefinedColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumnPrefix::class);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
        self::assertSame('field_', $metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testEmptyColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(EmptyColumnPrefix::class);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
        self::assertFalse($metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testFalseColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(FalseColumnPrefix::class);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
        self::assertFalse($metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testTrueColumnPrefix(): void
    {
        self::assertException(
            TypeError::class,
            fn () => Embedded::of(property: 'id', columnPrefix: true),
        );

        $class = new ReflectionClass(User::class);
        $property = $class->getProperty('id');
        self::assertException(
            TypeError::class,
            fn () => PropertyColumnPrefixResolver::resolve($property, true),
        );

        self::assertException(
            TypeError::class,
            fn () => new ResolvedEmbedded(property: 'id', class: UserId::class, columnPrefix: true),
        );
    }
}
