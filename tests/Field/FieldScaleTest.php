<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Scale\DefinedScale;
use Hereldar\DoctrineMapping\Tests\Field\Scale\NegativeScale;
use Hereldar\DoctrineMapping\Tests\Field\Scale\ScaleGreaterThanPrecision;
use Hereldar\DoctrineMapping\Tests\Field\Scale\UndefinedScale;
use Hereldar\DoctrineMapping\Tests\Field\Scale\ZeroScale;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldScaleTest extends TestCase
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
        $this->expectExceptionMessage("Invalid file 'ZeroScale.orm.php': Scale for property 'field' on class '".ZeroScale::class."' is negative or zero");

        $this->loadClassMetadata(ZeroScale::class);
    }

    public function testNegativeScale(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NegativeScale.orm.php': Scale for property 'field' on class '".NegativeScale::class."' is negative or zero");

        $this->loadClassMetadata(NegativeScale::class);
    }

    public function testScaleGreaterThanPrecision(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'ScaleGreaterThanPrecision.orm.php': Scale for property 'field' on class '".ScaleGreaterThanPrecision::class."' is greater than precision");

        $this->loadClassMetadata(ScaleGreaterThanPrecision::class);
    }
}
