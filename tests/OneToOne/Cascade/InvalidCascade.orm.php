<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\InvalidCascade;

return Entity::of(
    class: InvalidCascade::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: InvalidCascade::class,
        cascade: ['unknown'],
    ),
);
