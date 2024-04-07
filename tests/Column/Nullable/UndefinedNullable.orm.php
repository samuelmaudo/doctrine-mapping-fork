<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\UndefinedNullable;

return Entity::of(
    class: UndefinedNullable::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
    Field::of(property: 'nullableField')->withColumn(),
);
