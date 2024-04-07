<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Hereldar\DoctrineMapping\Tests\Column\Fixed\DefinedFixed;
use Hereldar\DoctrineMapping\Tests\Column\Fixed\UndefinedFixed;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnFixedTest extends TestCase
{
    public function testDefinedFixed(): void
    {
        $metadata = $this->loadClassMetadata(DefinedFixed::class);

        self::assertTrue($metadata->fieldMappings['id']['options']['fixed']);
        self::assertFalse($metadata->fieldMappings['field']['options']['fixed']);
    }

    public function testUndefinedFixed(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFixed::class);

        self::assertNull($metadata->fieldMappings['field']['options']['fixed']);
    }
}
