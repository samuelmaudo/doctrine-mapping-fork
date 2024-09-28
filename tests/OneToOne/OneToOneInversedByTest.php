<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\EmptyInversedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\ExistingInversedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\NonExistingInversedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\NullInversedBy;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\UndefinedInversedBy;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class OneToOneInversedByTest extends TestCase
{
    public function testExistingInversedBy(): void
    {
        $metadata = $this->loadClassMetadata(ExistingInversedBy::class);

        self::assertAssociationInversedBy($metadata, 'association', 'field');
    }

    public function testNonExistingInversedBy(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingInversedBy.orm.php': Target entity 'ExistingAssociation' has no property 'nonExistingField'");

        $this->loadClassMetadata(NonExistingInversedBy::class);
    }

    public function testEmptyInversedBy(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyInversedBy.orm.php': Empty inversed by attribute for association 'association'");

        $this->loadClassMetadata(EmptyInversedBy::class);
    }

    public function testUndefinedInversedBy(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedInversedBy::class);

        self::assertAssociationInversedByIsUndefined($metadata, 'association');
    }

    public function testNullInversedBy(): void
    {
        $metadata = $this->loadClassMetadata(NullInversedBy::class);

        self::assertAssociationInversedByIsUndefined($metadata, 'association');
    }
}
