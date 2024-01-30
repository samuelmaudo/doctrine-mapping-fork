<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Property\EmptyProperty;
use Hereldar\DoctrineMapping\Tests\Field\Property\ExistingProperty;
use Hereldar\DoctrineMapping\Tests\Field\Property\NonExistingProperty;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldPropertyTest extends TestCase
{
    public function testExistingProperty(): void
    {
        $metadata = $this->loadClassMetadata(ExistingProperty::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertSame('field', $metadata->fieldMappings['field']['fieldName']);
    }

    public function testNonExistingProperty(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingProperty.orm.php': Class '".NonExistingProperty::class."' has no property 'field'");

        $this->loadClassMetadata(NonExistingProperty::class);
    }

    public function testEmptyProperty(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyProperty.orm.php': Property name cannot be empty (class '".EmptyProperty::class."')");

        $this->loadClassMetadata(EmptyProperty::class);
    }
}
