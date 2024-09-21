<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Property\NonExistingProperty;

return Entity::of(
    class: NonExistingProperty::class,
)->withAssociations(
    OneToOne::of(property: 'association'),
);
