<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Precision\DefinedPrecision;
use Hereldar\DoctrineMapping\Tests\Column\Precision\MissingPrecision;
use Hereldar\DoctrineMapping\Tests\Column\Precision\NegativePrecision;
use Hereldar\DoctrineMapping\Tests\Column\Precision\UndefinedPrecision;
use Hereldar\DoctrineMapping\Tests\Column\Precision\ZeroPrecision;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnPrecisionTest extends TestCase
{
    public function testDefinedPrecision(): void
    {
        $metadata = $this->loadClassMetadata(DefinedPrecision::class);

        self::assertSame(10, $metadata->fieldMappings['field']['precision']);
    }

    public function testUndefinedPrecision(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedPrecision::class);

        self::assertNull($metadata->fieldMappings['field']['precision']);
    }

    public function testZeroPrecision(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'ZeroPrecision.orm.php': Negative or zero precision for field 'field'");

        $this->loadClassMetadata(ZeroPrecision::class);
    }

    public function testNegativePrecision(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NegativePrecision.orm.php': Negative or zero precision for field 'field'");

        $this->loadClassMetadata(NegativePrecision::class);
    }

    public function testMissingPrecision(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'MissingPrecision.orm.php': Missing precision for field 'field'");

        $this->loadClassMetadata(MissingPrecision::class);
    }
}
