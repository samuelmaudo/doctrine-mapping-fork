<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Property\ExistingProperty;

return Entity::of(
    class: ExistingProperty::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: ExistingProperty::class,
    ),
);
