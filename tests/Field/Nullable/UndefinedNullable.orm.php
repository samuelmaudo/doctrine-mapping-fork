<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\UndefinedNullable;

return Entity::of(
    class: UndefinedNullable::class,
)->withFields(
    Field::of(property: 'field'),
    Field::of(property: 'nullableField'),
);
