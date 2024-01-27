<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
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

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame(5, $metadata->fieldMappings['field']['scale']);
    }

    public function testUndefinedScale(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedScale::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertNull($metadata->fieldMappings['field']['scale']);
    }

    public function testZeroScale(): void
    {
        $this->expectException(MappingException::nonPositiveScale(ZeroScale::class, 'field'));

        $this->loadClassMetadata(ZeroScale::class);
    }

    public function testNegativeScale(): void
    {
        $this->expectException(MappingException::nonPositiveScale(NegativeScale::class, 'field'));

        $this->loadClassMetadata(NegativeScale::class);
    }

    public function testScaleGreaterThanPrecision(): void
    {
        $this->expectException(MappingException::scaleGreaterThanPrecision(ScaleGreaterThanPrecision::class, 'field'));

        $this->loadClassMetadata(ScaleGreaterThanPrecision::class);
    }
}
