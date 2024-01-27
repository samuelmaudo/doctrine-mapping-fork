<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
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

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame(10, $metadata->fieldMappings['field']['precision']);
    }

    public function testUndefinedPrecision(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedPrecision::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertNull($metadata->fieldMappings['field']['precision']);
    }

    public function testZeroPrecision(): void
    {
        $this->expectException(MappingException::nonPositivePrecision(ZeroPrecision::class, 'field'));

        $this->loadClassMetadata(ZeroPrecision::class);
    }

    public function testNegativePrecision(): void
    {
        $this->expectException(MappingException::nonPositivePrecision(NegativePrecision::class, 'field'));

        $this->loadClassMetadata(NegativePrecision::class);
    }

    public function testMissingPrecision(): void
    {
        $this->expectException(MappingException::missingPrecision(MissingPrecision::class, 'field'));

        $this->loadClassMetadata(MissingPrecision::class);
    }
}
