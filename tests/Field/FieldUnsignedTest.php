<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Tests\Field\Unsigned\DefinedUnsigned;
use Hereldar\DoctrineMapping\Tests\Field\Unsigned\UndefinedUnsigned;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldUnsignedTest extends TestCase
{
    public function testDefinedUnsigned(): void
    {
        $metadata = $this->loadClassMetadata(DefinedUnsigned::class);

        self::assertArrayHasKey('id', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['id']);
        self::assertTrue($metadata->fieldMappings['id']['options']['unsigned']);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertFalse($metadata->fieldMappings['field']['options']['unsigned']);
    }

    public function testUndefinedUnsigned(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedUnsigned::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertNull($metadata->fieldMappings['field']['options']['unsigned']);
    }
}
