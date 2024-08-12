<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\DefinedColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\EmptyColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\FalseColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\TrueColumnPrefix;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\UndefinedColumnPrefix;
use Hereldar\DoctrineMapping\Tests\TestCase;
use TypeError;

final class EmbeddedColumnPrefixTest extends TestCase
{
    public function testDefinedColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumnPrefix::class);

        self::assertEmbeddedColumnPrefix($metadata, 'field', 'prefix_');
    }

    public function testUndefinedColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumnPrefix::class);

        self::assertEmbeddedColumnPrefix($metadata, 'field', null);
    }

    public function testEmptyColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(EmptyColumnPrefix::class);

        self::assertEmbeddedColumnPrefix($metadata, 'field', false);
    }

    public function testFalseColumnPrefix(): void
    {
        $metadata = $this->loadClassMetadata(FalseColumnPrefix::class);

        self::assertEmbeddedColumnPrefix($metadata, 'field', false);
    }

    public function testTrueColumnPrefix(): void
    {
        self::assertException(
            TypeError::class,
            // @phpstan-ignore argument.type
            fn () => Embedded::of(property: 'field', columnPrefix: true),
        );

        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'TrueColumnPrefix.orm.php': Embedded::of(): Argument #3 (\$columnPrefix) must be of type false, bool given");

        $this->loadClassMetadata(TrueColumnPrefix::class);
    }
}
