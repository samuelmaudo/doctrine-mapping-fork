<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\DefinedNullable;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\DefinedNullablePrimaryKey;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\UndefinedNullable;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\UndefinedNullablePrimaryKey;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldNullableTest extends TestCase
{
    public function testDefinedNullable(): void
    {
        $metadata = $this->loadClassMetadata(DefinedNullable::class);

        self::assertArrayHasKey('id', $metadata->fieldMappings);
        self::assertFalse($metadata->fieldMappings['id']['nullable']);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertTrue($metadata->fieldMappings['field']['nullable']);
    }

    public function testUndefinedNullable(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedNullable::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertFalse($metadata->fieldMappings['field']['nullable']);

        self::assertArrayHasKey('nullableField', $metadata->fieldMappings);
        self::assertTrue($metadata->fieldMappings['nullableField']['nullable']);
    }

    public function testDefinedNullablePrimaryKey(): void
    {
        $this->expectException(
            MappingException::nullablePrimaryKey(
                DefinedNullablePrimaryKey::class,
                'id',
            )
        );

        $this->loadClassMetadata(DefinedNullablePrimaryKey::class);
    }

    public function testUndefinedNullablePrimaryKey(): void
    {
        $this->expectException(
            MappingException::nullablePrimaryKey(
                UndefinedNullablePrimaryKey::class,
                'id',
            )
        );

        $this->loadClassMetadata(UndefinedNullablePrimaryKey::class);
    }
}
