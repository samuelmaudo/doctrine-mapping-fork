<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\DefinedNullableId;

return Entity::of(
    class: DefinedNullableId::class,
)->withFields(
    Field::of(property: 'id', id: true)->withColumn(nullable: true),
);