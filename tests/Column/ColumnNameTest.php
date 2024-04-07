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

        self::assertSame('id_column', $metadata->fieldMappings['id']['columnName']);
        self::assertSame('parent_id_column', $metadata->fieldMappings['parentId']['columnName']);
    }

    public function testUndefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedName::class);

        self::assertSame('id', $metadata->fieldMappings['id']['columnName']);
        self::assertSame('parent_id', $metadata->fieldMappings['parentId']['columnName']);
    }

    public function testEmptyColumn(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyName.orm.php': Empty column name for field 'field'");

        $this->loadClassMetadata(EmptyName::class);
    }
}
