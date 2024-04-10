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

        self::assertFieldId($metadata, 'id', true);
        self::assertFieldId($metadata, 'field', false);
    }

    public function testUndefinedId(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedId::class);

        self::assertFieldId($metadata, 'field', false);
    }
}
