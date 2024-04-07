<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Unique\DefinedUnique;

return Entity::of(
    class: DefinedUnique::class,
)->withFields(
    Field::of(property: 'id')->withColumn(unique: true),
    Field::of(property: 'field')->withColumn(unique: false),
);
