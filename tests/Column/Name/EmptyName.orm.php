<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Name\EmptyName;

return Entity::of(
    class: EmptyName::class,
)->withFields(
    Field::of(property: 'field')->withColumn(name: ''),
);
