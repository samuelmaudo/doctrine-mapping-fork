<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\EmptyColumnDefinition;

return Entity::of(
    class: EmptyColumnDefinition::class,
)->withFields(
    Field::of(property: 'field', columnDefinition: ''),
);
