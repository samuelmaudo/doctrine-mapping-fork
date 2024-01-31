<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Tests\Field\PrimaryKey\DefinedPrimaryKey;
use Hereldar\DoctrineMapping\Tests\Field\PrimaryKey\UndefinedPrimaryKey;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldPrimaryKeyTest extends TestCase
{
    public function testDefinedPrimaryKey(): void
    {
        $metadata = $this->loadClassMetadata(DefinedPrimaryKey::class);

        self::assertTrue($metadata->fieldMappings['id']['id']);
        self::assertFalse($metadata->fieldMappings['field']['id']);
    }

    public function testUndefinedPrimaryKey(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedPrimaryKey::class);

        self::assertFalse($metadata->fieldMappings['field']['id']);
    }
}
