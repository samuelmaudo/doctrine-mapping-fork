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

        self::assertTrue($metadata->fieldMappings['id']['options']['fixed']);
        self::assertFalse($metadata->fieldMappings['field']['options']['fixed']);
    }

    public function testUndefinedFixed(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFixed::class);

        self::assertNull($metadata->fieldMappings['field']['options']['fixed']);
    }
}
