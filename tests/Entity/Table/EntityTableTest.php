<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entity\Table;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class EntityTableTest extends TestCase
{
    public function testDefinedTable(): void
    {
        $metadata = $this->loadClassMetadata(DefinedTable::class, __DIR__);

        self::assertSame(DefinedTable::class, $metadata->getName());
        self::assertEntity($metadata);
        self::assertSame('custom_table', $metadata->table['name']);
    }

    public function testUndefinedTable(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedTable::class, __DIR__);

        self::assertSame(UndefinedTable::class, $metadata->getName());
        self::assertEntity($metadata);
        self::assertSame('undefined_table', $metadata->table['name']);
    }

    public function testEmptyTable(): void
    {
        self::assertException(
            MappingException::emptyTable(EmptyTable::class),
            fn () => $this->loadClassMetadata(EmptyTable::class, __DIR__),
        );
    }
}
