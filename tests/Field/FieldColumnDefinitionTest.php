<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\DefinedColumnDefinition;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\EmptyColumnDefinition;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\UndefinedColumnDefinition;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldColumnDefinitionTest extends TestCase
{
    public function testDefinedColumnDefinition(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumnDefinition::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame('CHAR(32) NOT NULL', $metadata->fieldMappings['field']['columnDefinition']);
    }

    public function testUndefinedColumnDefinition(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumnDefinition::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertNull($metadata->fieldMappings['field']['columnDefinition']);
    }

    public function testEmptyColumnDefinition(): void
    {
        $this->expectException(MappingException::emptyColumnDefinition(EmptyColumnDefinition::class, 'field'));

        $this->loadClassMetadata(EmptyColumnDefinition::class);
    }
}
