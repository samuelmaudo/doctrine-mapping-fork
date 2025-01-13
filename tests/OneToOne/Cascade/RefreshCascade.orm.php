<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\RefreshCascade;

return Entity::of(
    class: RefreshCascade::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: RefreshCascade::class,
        cascade: [Cascade::Refresh],
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: RefreshCascade::class,
        cascade: ['refresh'],
    ),
);
