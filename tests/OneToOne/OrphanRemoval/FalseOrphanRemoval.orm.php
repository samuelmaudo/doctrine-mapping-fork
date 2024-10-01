<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval\FalseOrphanRemoval;

return Entity::of(
    class: FalseOrphanRemoval::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: FalseOrphanRemoval::class,
        orphanRemoval: false,
    ),
);
