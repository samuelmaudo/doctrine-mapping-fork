<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\DefinedColumnDefinition;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\EmptyColumnDefinition;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\UndefinedColumnDefinition;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldColumnDefinitionTest extends TestCase
{
    public function testDefinedColumnDefinition(): void
    {
        $metadata = $this->loadClassMetadata(DefinedColumnDefinition::class);

        self::assertSame('CHAR(32) NOT NULL', $metadata->fieldMappings['field']['columnDefinition']);
    }

    public function testUndefinedColumnDefinition(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedColumnDefinition::class);

        self::assertNull($metadata->fieldMappings['field']['columnDefinition']);
    }

    public function testEmptyColumnDefinition(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyColumnDefinition.orm.php': Column definition for property 'field' on class '".EmptyColumnDefinition::class."' is empty");

        $this->loadClassMetadata(EmptyColumnDefinition::class);
    }
}
