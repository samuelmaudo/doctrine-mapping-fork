<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Field\Column\DefinedColumn;
use Hereldar\DoctrineMapping\Tests\Field\Column\EmptyColumn;
use Hereldar\DoctrineMapping\Tests\Field\Column\UndefinedColumn;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldColumnTest extends TestCase
{
    public function testDefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumn::class);

        self::assertArrayHasKey('id', $metadata->fieldMappings);
        self::assertSame('id_column', $metadata->fieldMappings['id']['columnName']);

        self::assertArrayHasKey('parentId', $metadata->fieldMappings);
        self::assertSame('parent_id_column', $metadata->fieldMappings['parentId']['columnName']);
    }

    public function testUndefinedColumn(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumn::class);

        self::assertArrayHasKey('id', $metadata->fieldMappings);
        self::assertSame('id', $metadata->fieldMappings['id']['columnName']);

        self::assertArrayHasKey('parentId', $metadata->fieldMappings);
        self::assertSame('parent_id', $metadata->fieldMappings['parentId']['columnName']);
    }

    public function testEmptyColumn(): void
    {
        $this->expectException(MappingException::emptyColumn(EmptyColumn::class, 'field'));

        $this->loadClassMetadata(EmptyColumn::class);
    }
}
