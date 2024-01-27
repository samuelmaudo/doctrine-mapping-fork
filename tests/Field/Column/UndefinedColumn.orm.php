<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Column\UndefinedColumn;

return Entity::of(
    class: UndefinedColumn::class,
)->withFields(
    Field::of(property: 'id'),
    Field::of(property: 'parentId'),
);
