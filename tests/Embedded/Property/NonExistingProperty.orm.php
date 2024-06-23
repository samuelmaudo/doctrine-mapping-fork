<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\Property\NonExistingProperty;

return Entity::of(
    class: NonExistingProperty::class,
)->withFields(
    Embedded::of(property: 'field'),
);
