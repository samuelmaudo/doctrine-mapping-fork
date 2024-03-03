<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\DefinedNullable;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\DefinedNullableId;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\UndefinedNullable;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\UndefinedNullableId;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldNullableTest extends TestCase
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
        self::assertTrue($metadata->fieldMappings['nullableField']['nullable']);
    }

    public function testDefinedNullableId(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'DefinedNullableId.orm.php': Nullable ID for property 'id' on class '".DefinedNullableId::class."'");

        $this->loadClassMetadata(DefinedNullableId::class);
    }

    public function testUndefinedNullableId(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'UndefinedNullableId.orm.php': Nullable ID for property 'id' on class '".UndefinedNullableId::class."'");

        $this->loadClassMetadata(UndefinedNullableId::class);
    }
}
