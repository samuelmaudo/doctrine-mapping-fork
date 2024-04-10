<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Tests\Field\Insertable\DefinedInsertable;
use Hereldar\DoctrineMapping\Tests\Field\Insertable\UndefinedInsertable;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldInsertableTest extends TestCase
{
    public function testDefinedInsertable(): void
    {
        $metadata = $this->loadClassMetadata(DefinedInsertable::class);

        self::assertFieldNotInsertable($metadata, 'id', false);
        self::assertFieldNotInsertable($metadata, 'field', true);
    }

    public function testUndefinedInsertable(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedInsertable::class);

        self::assertFieldNotInsertable($metadata, 'field', false);
    }
}
