<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\DefinedNullable;

return Entity::of(
    class: DefinedNullable::class,
)->withFields(
    Field::of(property: 'id')->withColumn(nullable: false),
    Field::of(property: 'field')->withColumn(nullable: true),
);
