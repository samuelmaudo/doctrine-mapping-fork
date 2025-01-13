<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\AllCascade;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\DetachCascade;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\InvalidCascade;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\PersistCascade;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\RefreshCascade;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\RemoveCascade;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\UndefinedCascade;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class OneToOneCascadeTest extends TestCase
{
    private const REMOVE = 'remove';
    private const PERSIST = 'persist';
    private const REFRESH = 'refresh';
    private const DETACH = 'detach';

    public function testAllCascade(): void
    {
        $metadata = $this->loadClassMetadata(AllCascade::class);

        self::assertAssociationCascade($metadata, 'association1', [self::REMOVE, self::PERSIST, self::REFRESH, self::DETACH]);
        self::assertAssociationCascade($metadata, 'association2', [self::REMOVE, self::PERSIST, self::REFRESH, self::DETACH]);
    }

    public function testRemoveCascade(): void
    {
        $metadata = $this->loadClassMetadata(RemoveCascade::class);

        self::assertAssociationCascade($metadata, 'association1', [self::REMOVE]);
        self::assertAssociationCascade($metadata, 'association2', [self::REMOVE]);
    }

    public function testPersistCascade(): void
    {
        $metadata = $this->loadClassMetadata(PersistCascade::class);

        self::assertAssociationCascade($metadata, 'association1', [self::PERSIST]);
        self::assertAssociationCascade($metadata, 'association2', [self::PERSIST]);
    }

    public function testRefreshCascade(): void
    {
        $metadata = $this->loadClassMetadata(RefreshCascade::class);

        self::assertAssociationCascade($metadata, 'association1', [self::REFRESH]);
        self::assertAssociationCascade($metadata, 'association2', [self::REFRESH]);
    }

    public function testDetachCascade(): void
    {
        $metadata = $this->loadClassMetadata(DetachCascade::class);

        self::assertAssociationCascade($metadata, 'association1', [self::DETACH]);
        self::assertAssociationCascade($metadata, 'association2', [self::DETACH]);
    }

    public function testUndefinedCascade(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedCascade::class);

        self::assertAssociationCascade($metadata, 'association', []);
    }

    public function testInvalidCascade(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidCascade.orm.php': Invalid cascade option 'unknown' for association 'association'");

        $this->loadClassMetadata(InvalidCascade::class);
    }
}
