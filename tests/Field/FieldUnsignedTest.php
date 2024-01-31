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

        self::assertTrue($metadata->fieldMappings['id']['options']['unsigned']);
        self::assertFalse($metadata->fieldMappings['field']['options']['unsigned']);
    }

    public function testUndefinedUnsigned(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedUnsigned::class);

        self::assertNull($metadata->fieldMappings['field']['options']['unsigned']);
    }
}
