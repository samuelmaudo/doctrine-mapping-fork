<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\UndefinedColumnDefinition;

return Entity::of(
    class: UndefinedColumnDefinition::class,
)->withFields(
    Field::of(property: 'field'),
);
