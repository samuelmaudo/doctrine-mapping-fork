<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\UniqueConstraint;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\TestCase;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\DefinedColumn;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\DefinedColumns;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\EmptyColumn;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\EmptyColumns;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\InvalidColumn;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\NullColumns;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\UndefinedColumns;

final class UniqueConstraintColumnsTest extends TestCase
{
    public function testUndefinedColumns(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumns::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['columns']);
    }

    public function testDefinedColumns(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumns::class);

        self::assertSame(['column1', 'column2'], $metadata->table['uniqueConstraints'][0]['columns']);
    }

    public function testDefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumn::class);

        self::assertSame(['column'], $metadata->table['uniqueConstraints'][0]['columns']);
    }

    public function testEmptyColumns(): void
    {
        $metadata = $this->loadClassMetadata(EmptyColumns::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['columns']);
    }

    public function testEmptyColumn(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyColumn.orm.php': Column list of unique constraints should contain non-empty strings, but '' was found");

        $this->loadClassMetadata(EmptyColumn::class);
    }

    public function testInvalidColumn(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidColumn.orm.php': Column list of unique constraints should contain non-empty strings, but 42 was found");

        $this->loadClassMetadata(InvalidColumn::class);
    }

    public function testNullColumns(): void
    {
        $metadata = $this->loadClassMetadata(NullColumns::class);

        self::assertNull($metadata->table['uniqueConstraints'][0]['columns']);
    }
}
