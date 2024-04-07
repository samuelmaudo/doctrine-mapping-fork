<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Name\DefinedName;

return Entity::of(
    class: DefinedName::class,
)->withFields(
    Field::of(property: 'id')->withColumn(name: 'id_column'),
    Field::of(property: 'parentId')->withColumn(name: 'parent_id_column'),
);
