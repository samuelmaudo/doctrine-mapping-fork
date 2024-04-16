<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entity;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Entity\Table\DefinedTable;
use Hereldar\DoctrineMapping\Tests\Entity\Table\EmptyTable;
use Hereldar\DoctrineMapping\Tests\Entity\Table\UndefinedTable;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class EntityTableTest extends TestCase
{
    public function testDefinedTable(): void
    {
        $metadata = $this->loadClassMetadata(DefinedTable::class);

        self::assertSame(DefinedTable::class, $metadata->getName());
        self::assertEntity($metadata);
        self::assertSame('custom_table', $metadata->table['name']);
    }

    public function testUndefinedTable(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedTable::class);

        self::assertSame(UndefinedTable::class, $metadata->getName());
        self::assertEntity($metadata);
        self::assertSame('undefined_table', $metadata->table['name']);
    }

    public function testEmptyTable(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyTable.orm.php': Empty table name for class '".EmptyTable::class."'");

        $this->loadClassMetadata(EmptyTable::class);
    }
}
