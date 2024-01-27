<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Column\DefinedColumn;

return Entity::of(
    class: DefinedColumn::class,
)->withFields(
    Field::of(property: 'id', column: 'id_column'),
    Field::of(property: 'parentId', column: 'parent_id_column'),
);
