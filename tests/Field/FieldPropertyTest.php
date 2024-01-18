<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
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
        $this->expectException(
            MappingException::propertyNotFound(
                NonExistingProperty::class,
                'field',
            )
        );

        $this->loadClassMetadata(NonExistingProperty::class);
    }

    public function testEmptyProperty(): void
    {
        $this->expectException(MappingException::emptyPropertyName(EmptyProperty::class));

        $this->loadClassMetadata(EmptyProperty::class);
    }
}
