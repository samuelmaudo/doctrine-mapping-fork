<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\EmptyClass;

return Entity::of(
    class: EmptyClass::class,
)->withFields(
    Embedded::of(property: 'id', class: ''),
);
