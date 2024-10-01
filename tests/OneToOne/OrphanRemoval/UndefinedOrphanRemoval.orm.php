<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval\UndefinedOrphanRemoval;

return Entity::of(
    class: UndefinedOrphanRemoval::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: UndefinedOrphanRemoval::class,
    ),
);
