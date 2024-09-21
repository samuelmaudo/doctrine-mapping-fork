<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\AnonymousTargetEntity;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\EmptyTargetEntity;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\ExistingAssociation;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\ExistingTargetEntity;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\MissingTargetEntity;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\NonExistingTargetEntity;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\UndefinedTargetEntity;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class OneToOneTargetEntityTest extends TestCase
{
    public function testExistingTargetEntity(): void
    {
        $metadata = $this->loadClassMetadata(ExistingTargetEntity::class);

        self::assertAssociationTargetEntity($metadata, 'association', ExistingAssociation::class);
    }

    public function testNonExistingTargetEntity(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'NonExistingTargetEntity.orm.php': Class 'NonExisting' does not exist");

        $this->loadClassMetadata(NonExistingTargetEntity::class);
    }

    public function testEmptyTargetEntity(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyTargetEntity.orm.php': Class name cannot be empty");

        $this->loadClassMetadata(EmptyTargetEntity::class);
    }

    public function testAnonymousTargetEntity(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessageMatches("/Invalid file 'AnonymousTargetEntity.orm.php': Class 'class@anonymous[^']*' is anonymous/");

        $this->loadClassMetadata(AnonymousTargetEntity::class);
    }

    public function testUndefinedTargetEntity(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedTargetEntity::class);

        self::assertAssociationTargetEntity($metadata, 'association', ExistingAssociation::class);
    }

    public function testMissingTargetEntity(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'MissingTargetEntity.orm.php': Missing target entity for property 'association' on class 'MissingTargetEntity'");

        $this->loadClassMetadata(MissingTargetEntity::class);
    }
}
