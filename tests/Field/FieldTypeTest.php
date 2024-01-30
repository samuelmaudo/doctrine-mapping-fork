<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Type\DefinedType;
use Hereldar\DoctrineMapping\Tests\Field\Type\EmptyType;
use Hereldar\DoctrineMapping\Tests\Field\Type\UndefinedType;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldTypeTest extends TestCase
{
    public function testDefinedType(): void
    {
        $metadata = $this->loadClassMetadata(DefinedType::class);

        self::assertArrayHasKey('id', $metadata->fieldMappings);
        self::assertSame('integer', $metadata->fieldMappings['id']['type']);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame('json', $metadata->fieldMappings['field']['type']);
    }

    public function testUndefinedType(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedType::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame('string', $metadata->fieldMappings['field']['type']);
    }

    public function testEmptyType(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyType.orm.php': Type for property 'field' on class '".EmptyType::class."' is empty");

        $this->loadClassMetadata(EmptyType::class);
    }
}
