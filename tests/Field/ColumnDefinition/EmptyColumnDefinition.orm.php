<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Field\ColumnDefinition\EmptyColumnDefinition;

return MappedSuperclass::of(
    class: EmptyColumnDefinition::class,
)->withFields(
    Field::of(property: 'field', columnDefinition: ''),
);
