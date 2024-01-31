<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Precision\DefinedPrecision;
use Hereldar\DoctrineMapping\Tests\Field\Precision\MissingPrecision;
use Hereldar\DoctrineMapping\Tests\Field\Precision\NegativePrecision;
use Hereldar\DoctrineMapping\Tests\Field\Precision\UndefinedPrecision;
use Hereldar\DoctrineMapping\Tests\Field\Precision\ZeroPrecision;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldPrecisionTest extends TestCase
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
        $this->expectExceptionMessage("Invalid file 'ZeroPrecision.orm.php': Precision for property 'field' on class '".ZeroPrecision::class."' is negative or zero");

        $this->loadClassMetadata(ZeroPrecision::class);
    }

    public function testNegativePrecision(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NegativePrecision.orm.php': Precision for property 'field' on class '".NegativePrecision::class."' is negative or zero");

        $this->loadClassMetadata(NegativePrecision::class);
    }

    public function testMissingPrecision(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'MissingPrecision.orm.php': Precision for property 'field' on class '".MissingPrecision::class."' is missing");

        $this->loadClassMetadata(MissingPrecision::class);
    }
}
