<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Hereldar\DoctrineMapping\Tests\Column\Unsigned\DefinedUnsigned;
use Hereldar\DoctrineMapping\Tests\Column\Unsigned\UndefinedUnsigned;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnUnsignedTest extends TestCase
{
    public function testDefinedUnsigned(): void
    {
        $metadata = $this->loadClassMetadata(DefinedUnsigned::class);

        self::assertFieldOption($metadata, 'id', 'unsigned', true);
        self::assertFieldOption($metadata, 'field', 'unsigned', false);
    }

    public function testUndefinedUnsigned(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedUnsigned::class);

        self::assertFieldOption($metadata, 'field', 'unsigned', null);
    }
}
