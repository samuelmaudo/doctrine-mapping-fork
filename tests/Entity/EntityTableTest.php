<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entity;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
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
        $this->expectException(MappingException::emptyTable(EmptyTable::class));

        $this->loadClassMetadata(EmptyTable::class);
    }
}
