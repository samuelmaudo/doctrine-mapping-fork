<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\RemoveCascade;

return Entity::of(
    class: RemoveCascade::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: RemoveCascade::class,
        cascade: [Cascade::Remove],
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: RemoveCascade::class,
        cascade: ['remove'],
    ),
);
