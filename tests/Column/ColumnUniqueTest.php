<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Hereldar\DoctrineMapping\Tests\Column\Unique\DefinedUnique;
use Hereldar\DoctrineMapping\Tests\Column\Unique\UndefinedUnique;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnUniqueTest extends TestCase
{
    public function testDefinedUnique(): void
    {
        $metadata = $this->loadClassMetadata(DefinedUnique::class);

        self::assertTrue($metadata->fieldMappings['id']['unique']);
        self::assertFalse($metadata->fieldMappings['field']['unique']);
    }

    public function testUndefinedUnique(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedUnique::class);

        self::assertFalse($metadata->fieldMappings['field']['unique']);
    }
}
