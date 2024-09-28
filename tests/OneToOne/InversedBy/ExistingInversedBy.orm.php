<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\ExistingAssociation;
use Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy\ExistingInversedBy;

return Entity::of(
    class: ExistingInversedBy::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: ExistingAssociation::class,
        inversedBy: 'field',
    ),
);
