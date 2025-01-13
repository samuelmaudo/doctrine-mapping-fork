<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\DetachCascade;

return Entity::of(
    class: DetachCascade::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: DetachCascade::class,
        cascade: [Cascade::Detach],
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: DetachCascade::class,
        cascade: ['detach'],
    ),
);
