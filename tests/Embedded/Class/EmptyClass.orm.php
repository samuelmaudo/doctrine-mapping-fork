<?php

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingClass;

return Entity::of(
    class: ExistingClass::class,
)->withFields(
    Embedded::of(property: 'id', class: ''),
);
