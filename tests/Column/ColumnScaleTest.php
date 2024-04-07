<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Scale\DefinedScale;
use Hereldar\DoctrineMapping\Tests\Column\Scale\NegativeScale;
use Hereldar\DoctrineMapping\Tests\Column\Scale\ScaleGreaterThanPrecision;
use Hereldar\DoctrineMapping\Tests\Column\Scale\UndefinedScale;
use Hereldar\DoctrineMapping\Tests\Column\Scale\ZeroScale;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnScaleTest extends TestCase
{
    public function testDefinedScale(): void
    {
        $metadata = $this->loadClassMetadata(DefinedScale::class);

        self::assertSame(5, $metadata->fieldMappings['field']['scale']);
    }

    public function testUndefinedScale(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedScale::class);

        self::assertNull($metadata->fieldMappings['field']['scale']);
    }

    public function testZeroScale(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'ZeroScale.orm.php': Negative or zero scale for field 'field'");

        $this->loadClassMetadata(ZeroScale::class);
    }

    public function testNegativeScale(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NegativeScale.orm.php': Negative or zero scale for field 'field'");

        $this->loadClassMetadata(NegativeScale::class);
    }

    public function testScaleGreaterThanPrecision(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'ScaleGreaterThanPrecision.orm.php': Scale for field 'field' is greater than precision");

        $this->loadClassMetadata(ScaleGreaterThanPrecision::class);
    }
}
