<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Type\DefinedType;
use Hereldar\DoctrineMapping\Tests\Field\Type\EmptyType;
use Hereldar\DoctrineMapping\Tests\Field\Type\UndefinedType;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldTypeTest extends TestCase
{
    public function testDefinedType(): void
    {
        $metadata = $this->loadClassMetadata(DefinedType::class);

        self::assertFieldType($metadata, 'id', 'integer');
        self::assertFieldType($metadata, 'field', 'json');
    }

    public function testUndefinedType(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedType::class);

        self::assertFieldType($metadata, 'field', 'string');
    }

    public function testEmptyType(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyType.orm.php': Empty type for field 'field'");

        $this->loadClassMetadata(EmptyType::class);
    }
}
