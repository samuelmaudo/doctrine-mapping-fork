<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Name\DefinedName;
use Hereldar\DoctrineMapping\Tests\Column\Name\EmptyName;
use Hereldar\DoctrineMapping\Tests\Column\Name\UndefinedName;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnNameTest extends TestCase
{
    public function testDefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(DefinedName::class);

        self::assertFieldColumnName($metadata, 'id', 'id_column');
        self::assertFieldColumnName($metadata, 'parentId', 'parent_id_column');
    }

    public function testUndefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedName::class);

        self::assertFieldColumnName($metadata, 'id', 'id');
        self::assertFieldColumnName($metadata, 'parentId', 'parentId');
    }

    public function testEmptyColumn(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyName.orm.php': Empty column name for field 'field'");

        $this->loadClassMetadata(EmptyName::class);
    }
}
