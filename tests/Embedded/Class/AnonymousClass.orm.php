<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\ExistingClass;

$object = new class() {};

return Entity::of(
    class: ExistingClass::class,
)->withFields(
    Embedded::of(property: 'id', class: $object::class),
);
