<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Class\MissingClass;

return Entity::of(
    class: MissingClass::class,
)->withFields(
    Embedded::of(property: 'id'),
);
