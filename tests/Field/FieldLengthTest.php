<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Field\Length\DefinedLength;
use Hereldar\DoctrineMapping\Tests\Field\Length\NegativeLength;
use Hereldar\DoctrineMapping\Tests\Field\Length\UndefinedLength;
use Hereldar\DoctrineMapping\Tests\Field\Length\ZeroLength;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldLengthTest extends TestCase
{
    public function testDefinedLength(): void
    {
        $metadata = $this->loadClassMetadata(DefinedLength::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame(5, $metadata->fieldMappings['field']['length']);
    }

    public function testUndefinedLength(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedLength::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertNull($metadata->fieldMappings['field']['length']);
    }

    public function testZeroLength(): void
    {
        $this->expectException(MappingException::nonPositiveLength(ZeroLength::class, 'field'));

        $this->loadClassMetadata(ZeroLength::class);
    }

    public function testNegativeLength(): void
    {
        $this->expectException(MappingException::nonPositiveLength(NegativeLength::class, 'field'));

        $this->loadClassMetadata(NegativeLength::class);
    }
}
