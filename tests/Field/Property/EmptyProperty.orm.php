<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Property\EmptyProperty;

return Entity::of(
    class: EmptyProperty::class,
)->withFields(
    Field::of(property: ''),
);
