<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\OneToOne\Property\EmptyProperty;
use Hereldar\DoctrineMapping\Tests\OneToOne\Property\ExistingProperty;
use Hereldar\DoctrineMapping\Tests\OneToOne\Property\NonExistingProperty;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class OneToOnePropertyTest extends TestCase
{
    public function testExistingProperty(): void
    {
        $metadata = $this->loadClassMetadata(ExistingProperty::class);

        self::assertAssociationName($metadata, 'association', 'association');
    }

    public function testNonExistingProperty(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingProperty.orm.php': Class 'NonExistingProperty' has no property 'association'");

        $this->loadClassMetadata(NonExistingProperty::class);
    }

    public function testEmptyProperty(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyProperty.orm.php': Property name cannot be empty");

        $this->loadClassMetadata(EmptyProperty::class);
    }
}
