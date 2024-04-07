<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\DefinedNullable;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\DefinedNullableId;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\UndefinedNullable;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\NullableId;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnNullableTest extends TestCase
{
    public function testDefinedNullable(): void
    {
        $metadata = $this->loadClassMetadata(DefinedNullable::class);

        self::assertFalse($metadata->fieldMappings['id']['nullable']);
        self::assertTrue($metadata->fieldMappings['field']['nullable']);
    }

    public function testUndefinedNullable(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedNullable::class);

        self::assertFalse($metadata->fieldMappings['field']['nullable']);
        self::assertFalse($metadata->fieldMappings['nullableField']['nullable']);
    }

    public function testDefinedNullableId(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'DefinedNullableId.orm.php': Nullable ID for field 'id'");

        $this->loadClassMetadata(DefinedNullableId::class);
    }

    public function testNullableId(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NullableId.orm.php': Nullable ID for field 'id'");

        $this->loadClassMetadata(NullableId::class);
    }
}
