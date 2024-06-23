<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Property\EmptyProperty;

return Entity::of(
    class: EmptyProperty::class,
)->withFields(
    Embedded::of(property: ''),
);
