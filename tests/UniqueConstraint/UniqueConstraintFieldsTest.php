<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\UniqueConstraint;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\TestCase;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\DefinedField;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\DefinedFields;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\EmptyField;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\EmptyFields;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\InvalidField;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\NullFields;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\UndefinedFields;

final class UniqueConstraintFieldsTest extends TestCase
{
    public function testUndefinedFields(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFields::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['fields']);
    }

    public function testDefinedFields(): void
    {
        $metadata = $this->loadClassMetadata(DefinedFields::class);

        self::assertSame(['field1', 'field2'], $metadata->table['uniqueConstraints'][0]['fields']);
    }

    public function testDefinedField(): void
    {
        $metadata = $this->loadClassMetadata(DefinedField::class);

        self::assertSame(['field'], $metadata->table['uniqueConstraints'][0]['fields']);
    }

    public function testEmptyFields(): void
    {
        $metadata = $this->loadClassMetadata(EmptyFields::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['fields']);
    }

    public function testEmptyField(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyField.orm.php': Field list of unique constraints should contain non-empty strings, but '' was found");

        $this->loadClassMetadata(EmptyField::class);
    }

    public function testInvalidField(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidField.orm.php': Field list of unique constraints should contain non-empty strings, but 42 was found");

        $this->loadClassMetadata(InvalidField::class);
    }

    public function testNullFields(): void
    {
        $metadata = $this->loadClassMetadata(NullFields::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['fields']);
    }
}
