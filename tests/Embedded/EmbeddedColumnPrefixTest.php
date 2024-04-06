<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbedded;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\DefinedColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\EmptyColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\FalseColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\TrueColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\UndefinedColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\ValueObject;
use Hereldar\DoctrineMapping\Tests\TestCase;
use TypeError;

final class EmbeddedColumnPrefixTest extends TestCase
{
    public function testDefinedColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumnPrefix::class);

        self::assertSame('prefix_', $metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testUndefinedColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumnPrefix::class);

        self::assertSame('field_', $metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testEmptyColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(EmptyColumnPrefix::class);

        self::assertFalse($metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testFalseColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(FalseColumnPrefix::class);

        self::assertFalse($metadata->embeddedClasses['field']['columnPrefix']);
    }

    public function testTrueColumnPrefix(): void
    {
        self::assertException(
            TypeError::class,
            fn () => Embedded::of(property: 'field', columnPrefix: true),
        );

        self::assertException(
            TypeError::class,
            fn () => new ResolvedEmbedded(property: 'field', class: ValueObject::class, columnPrefix: true),
        );

        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'TrueColumnPrefix.orm.php': Embedded::of(): Argument #3 (\$columnPrefix) must be of type false, bool given");

        $this->loadClassMetadata(TrueColumnPrefix::class);
    }
}
