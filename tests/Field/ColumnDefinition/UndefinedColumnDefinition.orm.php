<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\UndefinedColumnDefinition;

return MappedSuperclass::of(
    class: UndefinedColumnDefinition::class,
)->withFields(
    Field::of(property: 'field'),
);
