<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Property\EmptyProperty;

return Entity::of(
    class: EmptyProperty::class,
)->withAssociations(
    OneToOne::of(property: ''),
);
