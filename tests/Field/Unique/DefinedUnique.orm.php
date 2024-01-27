<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Unique\DefinedUnique;

return Entity::of(
    class: DefinedUnique::class,
)->withFields(
    Field::of(property: 'id', unique: true),
    Field::of(property: 'field', unique: false),
);
