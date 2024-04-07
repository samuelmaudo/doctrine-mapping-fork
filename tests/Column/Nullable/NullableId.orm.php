<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\NullableId;

return Entity::of(
    class: NullableId::class,
)->withFields(
    Field::of(property: 'id', id: true)->withColumn(nullable: true),
);
