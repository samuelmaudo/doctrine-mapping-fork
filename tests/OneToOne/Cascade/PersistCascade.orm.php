<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\PersistCascade;

return Entity::of(
    class: PersistCascade::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: PersistCascade::class,
        cascade: [Cascade::Persist],
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: PersistCascade::class,
        cascade: ['persist'],
    ),
);
