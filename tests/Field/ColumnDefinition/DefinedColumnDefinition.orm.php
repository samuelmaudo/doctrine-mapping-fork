<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\DefinedColumnDefinition;

return Entity::of(
    class: DefinedColumnDefinition::class,
)->withFields(
    Field::of(property: 'field', columnDefinition: 'CHAR(32) NOT NULL'),
);
