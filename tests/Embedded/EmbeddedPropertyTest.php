<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Embedded\Property\EmptyProperty;
use Hereldar\DoctrineMapping\Tests\Embedded\Property\ExistingProperty;
use Hereldar\DoctrineMapping\Tests\Embedded\Property\NonExistingProperty;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class EmbeddedPropertyTest extends TestCase
{
    public function testExistingProperty(): void
    {
        $metadata = $this->loadClassMetadata(ExistingProperty::class);

        self::assertArrayHasKey('field', $metadata->embeddedClasses);
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
