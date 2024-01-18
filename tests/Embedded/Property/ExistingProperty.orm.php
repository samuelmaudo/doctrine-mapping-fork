<?php

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Property\ExistingProperty;

return Entity::of(
    class: ExistingProperty::class,
)->withFields(
    Embedded::of(property: 'field'),
);
