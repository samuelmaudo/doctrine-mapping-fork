<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\DefinedColumnDefinition;

return MappedSuperclass::of(
    class: DefinedColumnDefinition::class,
)->withFields(
    Field::of(property: 'field', columnDefinition: 'CHAR(32) NOT NULL'),
);
