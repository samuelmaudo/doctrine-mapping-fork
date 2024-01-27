<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Unique\UndefinedUnique;

return Entity::of(
    class: UndefinedUnique::class,
)->withFields(
    Field::of(property: 'field'),
);
