<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\NullInversedBy;

return Entity::of(
    class: NullInversedBy::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: NullInversedBy::class,
        inversedBy: null,
    ),
);
