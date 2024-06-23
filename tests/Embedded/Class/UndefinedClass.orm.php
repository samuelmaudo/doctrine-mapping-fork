<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\UndefinedClass;

return Entity::of(
    class: UndefinedClass::class,
)->withFields(
    Embedded::of(property: 'id'),
    Embedded::of(property: 'field'),
);
