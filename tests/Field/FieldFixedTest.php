<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Tests\Field\Fixed\DefinedFixed;
use Hereldar\DoctrineMapping\Tests\Field\Fixed\UndefinedFixed;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldFixedTest extends TestCase
{
    public function testDefinedFixed(): void
    {
        $metadata = $this->loadClassMetadata(DefinedFixed::class);

        self::assertArrayHasKey('id', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['id']);
        self::assertTrue($metadata->fieldMappings['id']['options']['fixed']);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertFalse($metadata->fieldMappings['field']['options']['fixed']);
    }

    public function testUndefinedFixed(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFixed::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertNull($metadata->fieldMappings['field']['options']['fixed']);
    }
}
