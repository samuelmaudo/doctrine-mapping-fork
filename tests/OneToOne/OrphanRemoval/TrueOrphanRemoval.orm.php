<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval\TrueOrphanRemoval;

return Entity::of(
    class: TrueOrphanRemoval::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: TrueOrphanRemoval::class,
        orphanRemoval: true,
    ),
);
