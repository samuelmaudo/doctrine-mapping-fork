<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Column\EmptyColumn;

return Entity::of(
    class: EmptyColumn::class,
)->withFields(
    Field::of(property: 'field', column: ''),
);
