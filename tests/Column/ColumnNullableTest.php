<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\DefinedNullable;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\NullableId;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\UndefinedNullable;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnNullableTest extends TestCase
{
    public function testDefinedNullable(): void
    {
        $metadata = $this->loadClassMetadata(DefinedNullable::class);

        self::assertFieldNullable($metadata, 'id', false);
        self::assertFieldNullable($metadata, 'field', true);
    }

    public function testUndefinedNullable(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedNullable::class);

        self::assertFieldNullable($metadata, 'field', false);
        self::assertFieldNullable($metadata, 'nullableField', false);
    }

    public function testNullableId(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NullableId.orm.php': Nullable column for ID 'id'");

        $this->loadClassMetadata(NullableId::class);
    }
}
