<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Index;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Index\Fields\DefinedField;
use Hereldar\DoctrineMapping\Tests\Index\Fields\DefinedFields;
use Hereldar\DoctrineMapping\Tests\Index\Fields\EmptyField;
use Hereldar\DoctrineMapping\Tests\Index\Fields\EmptyFields;
use Hereldar\DoctrineMapping\Tests\Index\Fields\InvalidField;
use Hereldar\DoctrineMapping\Tests\Index\Fields\NullFields;
use Hereldar\DoctrineMapping\Tests\Index\Fields\UndefinedFields;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class IndexFieldsTest extends TestCase
{
    public function testUndefinedFields(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFields::class);

        self::assertNull($metadata->table['indexes'][0]['fields']);
    }

    public function testDefinedFields(): void
    {
        $metadata = $this->loadClassMetadata(DefinedFields::class);

        self::assertSame(['field1', 'field2'], $metadata->table['indexes'][0]['fields']);
    }

    public function testDefinedField(): void
    {
        $metadata = $this->loadClassMetadata(DefinedField::class);

        self::assertSame(['field'], $metadata->table['indexes'][0]['fields']);
    }

    public function testEmptyFields(): void
    {
        $metadata = $this->loadClassMetadata(EmptyFields::class);

        self::assertNull($metadata->table['indexes'][0]['fields']);
    }

    public function testEmptyField(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyField.orm.php': Field list of index '1' for class '".EmptyField::class."' should contain non-empty strings, but '' was found");

        $this->loadClassMetadata(EmptyField::class);
    }

    public function testInvalidField(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidField.orm.php': Field list of index '1' for class '".InvalidField::class."' should contain non-empty strings, but 42 was found");

        $this->loadClassMetadata(InvalidField::class);
    }

    public function testNullFields(): void
    {
        $metadata = $this->loadClassMetadata(NullFields::class);

        self::assertNull($metadata->table['indexes'][0]['fields']);
    }
}
