<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
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
