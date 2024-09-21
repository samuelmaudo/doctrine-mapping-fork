<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\AnonymousClass;

$object = new class() {};

return Entity::of(
    class: AnonymousClass::class,
)->withFields(
    Embedded::of(property: 'id', class: $object::class),
);
