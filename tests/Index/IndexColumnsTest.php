<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Index;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Index\Columns\DefinedColumn;
use Hereldar\DoctrineMapping\Tests\Index\Columns\DefinedColumns;
use Hereldar\DoctrineMapping\Tests\Index\Columns\EmptyColumn;
use Hereldar\DoctrineMapping\Tests\Index\Columns\EmptyColumns;
use Hereldar\DoctrineMapping\Tests\Index\Columns\InvalidColumn;
use Hereldar\DoctrineMapping\Tests\Index\Columns\NullColumns;
use Hereldar\DoctrineMapping\Tests\Index\Columns\UndefinedColumns;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class IndexColumnsTest extends TestCase
{
    public function testUndefinedColumns(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumns::class);

        self::assertNull($metadata->table['indexes'][0]['columns']);
    }

    public function testDefinedColumns(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumns::class);

        self::assertSame(['column1', 'column2'], $metadata->table['indexes'][0]['columns']);
    }

    public function testDefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumn::class);

        self::assertSame(['column'], $metadata->table['indexes'][0]['columns']);
    }

    public function testEmptyColumns(): void
    {
        $metadata = $this->loadClassMetadata(EmptyColumns::class);

        self::assertNull($metadata->table['indexes'][0]['columns']);
    }

    public function testEmptyColumn(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyColumn.orm.php': Column list of index '1' for class '".EmptyColumn::class."' should contain non-empty strings, but '' was found");

        $this->loadClassMetadata(EmptyColumn::class);
    }

    public function testInvalidColumn(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidColumn.orm.php': Column list of index '1' for class '".InvalidColumn::class."' should contain non-empty strings, but 42 was found");

        $this->loadClassMetadata(InvalidColumn::class);
    }

    public function testNullColumns(): void
    {
        $metadata = $this->loadClassMetadata(NullColumns::class);

        self::assertNull($metadata->table['indexes'][0]['columns']);
    }
}
