<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Column\DefinedColumn;
use Hereldar\DoctrineMapping\Tests\Field\Column\EmptyColumn;
use Hereldar\DoctrineMapping\Tests\Field\Column\UndefinedColumn;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldColumnTest extends TestCase
{
    public function testDefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumn::class);

        self::assertSame('id_column', $metadata->fieldMappings['id']['columnName']);
        self::assertSame('parent_id_column', $metadata->fieldMappings['parentId']['columnName']);
    }

    public function testUndefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumn::class);

        self::assertSame('id', $metadata->fieldMappings['id']['columnName']);
        self::assertSame('parent_id', $metadata->fieldMappings['parentId']['columnName']);
    }

    public function testEmptyColumn(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyColumn.orm.php': Empty column for property 'field' on class '".EmptyColumn::class."'");

        $this->loadClassMetadata(EmptyColumn::class);
    }
}
