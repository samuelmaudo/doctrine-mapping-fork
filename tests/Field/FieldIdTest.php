<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Tests\Field\Id\DefinedId;
use Hereldar\DoctrineMapping\Tests\Field\Id\UndefinedId;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldIdTest extends TestCase
{
    public function testDefinedId(): void
    {
        $metadata = $this->loadClassMetadata(DefinedId::class);

        self::assertTrue($metadata->fieldMappings['id']['id']);
        self::assertFalse($metadata->fieldMappings['field']['id']);
    }

    public function testUndefinedId(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedId::class);

        self::assertFalse($metadata->fieldMappings['field']['id']);
    }
}
