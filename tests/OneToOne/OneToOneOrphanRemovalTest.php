<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne;

use Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval\FalseOrphanRemoval;
use Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval\TrueOrphanRemoval;
use Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval\UndefinedOrphanRemoval;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class OneToOneOrphanRemovalTest extends TestCase
{
    public function testTrueOrphanRemoval(): void
    {
        $metadata = $this->loadClassMetadata(TrueOrphanRemoval::class);

        self::assertAssociationOrphanRemoval($metadata, 'association', true);
    }

    public function testFalseOrphanRemoval(): void
    {
        $metadata = $this->loadClassMetadata(FalseOrphanRemoval::class);

        self::assertAssociationOrphanRemoval($metadata, 'association', false);
    }

    public function testUndefinedOrphanRemoval(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedOrphanRemoval::class);

        self::assertAssociationOrphanRemoval($metadata, 'association', false);
    }
}
