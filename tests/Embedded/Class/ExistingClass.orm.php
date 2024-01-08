<?php

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingField;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingId;

return Entity::of(
    class: ExistingClass::class,
)->withFields(
    Embedded::of(property: 'id', class: ExistingId::class),
    Embedded::of(property: 'field', class: ExistingField::class),
);
