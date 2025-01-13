<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\AllCascade;

return Entity::of(
    class: AllCascade::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: AllCascade::class,
        cascade: [Cascade::All],
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: AllCascade::class,
        cascade: ['all'],
    ),
);
