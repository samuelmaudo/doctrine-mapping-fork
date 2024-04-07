<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Name\UndefinedName;

return Entity::of(
    class: UndefinedName::class,
)->withFields(
    Field::of(property: 'id')->withColumn(),
    Field::of(property: 'parentId')->withColumn(),
);
