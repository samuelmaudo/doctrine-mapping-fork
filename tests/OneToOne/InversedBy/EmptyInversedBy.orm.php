<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\EmptyInversedBy;

return Entity::of(
    class: EmptyInversedBy::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: EmptyInversedBy::class,
        inversedBy: '',
    ),
);