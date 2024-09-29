<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\ExtraLazyFetch;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\EagerFetch;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\InvalidFetch;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\LazyFetch;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\UndefinedFetch;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class OneToOneFetchTest extends TestCase
{
    private const LAZY = 2;
    private const EAGER = 3;
    private const EXTRA_LAZY = 4;

    public function testLazyFetch(): void
    {
        $metadata = $this->loadClassMetadata(LazyFetch::class);

        self::assertAssociationFetch($metadata, 'association1', self::LAZY);
        self::assertAssociationFetch($metadata, 'association2', self::LAZY);
    }

    public function testEagerFetch(): void
    {
        $metadata = $this->loadClassMetadata(EagerFetch::class);

        self::assertAssociationFetch($metadata, 'association1', self::EAGER);
        self::assertAssociationFetch($metadata, 'association2', self::EAGER);
    }

    public function testExtraLazyFetch(): void
    {
        $metadata = $this->loadClassMetadata(ExtraLazyFetch::class);

        self::assertAssociationFetch($metadata, 'association1', self::EXTRA_LAZY);
        self::assertAssociationFetch($metadata, 'association2', self::EXTRA_LAZY);
    }

    public function testUndefinedFetch(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedFetch::class);

        self::assertAssociationFetch($metadata, 'association', self::LAZY);
    }

    public function testInvalidFetch(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidFetch.orm.php': Invalid fetch option 'UNKNOWN' for association 'association'");

        $this->loadClassMetadata(InvalidFetch::class);
    }
}
