<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Tests\Field\Unique\DefinedUnique;
use Hereldar\DoctrineMapping\Tests\Field\Unique\UndefinedUnique;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldUniqueTest extends TestCase
{
    public function testDefinedUnique(): void
    {
        $metadata = $this->loadClassMetadata(DefinedUnique::class);

        self::assertArrayHasKey('id', $metadata->fieldMappings);
        self::assertTrue($metadata->fieldMappings['id']['unique']);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertFalse($metadata->fieldMappings['field']['unique']);
    }

    public function testUndefinedUnique(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedUnique::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertFalse($metadata->fieldMappings['field']['unique']);
    }
}
