<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\EmptyMappedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\ExistingMappedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\NonExistingMappedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\NullMappedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\UndefinedMappedBy;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class OneToOneMappedByTest extends TestCase
{
    public function testExistingMappedBy(): void
    {
        $metadata = $this->loadClassMetadata(ExistingMappedBy::class);

        self::assertAssociationMappedBy($metadata, 'association', 'field');
    }

    public function testNonExistingMappedBy(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingMappedBy.orm.php': Target entity 'ExistingAssociation' has no property 'nonExistingField'");

        $this->loadClassMetadata(NonExistingMappedBy::class);
    }

    public function testEmptyMappedBy(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyMappedBy.orm.php': Empty mapped by attribute for association 'association'");

        $this->loadClassMetadata(EmptyMappedBy::class);
    }

    public function testUndefinedMappedBy(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedMappedBy::class);

        self::assertAssociationMappedByIsUndefined($metadata, 'association');
    }

    public function testNullMappedBy(): void
    {
        $metadata = $this->loadClassMetadata(NullMappedBy::class);

        self::assertAssociationMappedByIsUndefined($metadata, 'association');
    }
}
