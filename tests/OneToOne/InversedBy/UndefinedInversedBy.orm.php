<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\UndefinedInversedBy;

return Entity::of(
    class: UndefinedInversedBy::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: UndefinedInversedBy::class,
    ),
);
