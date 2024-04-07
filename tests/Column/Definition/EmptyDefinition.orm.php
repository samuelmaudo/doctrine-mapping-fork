<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Column\Definition\EmptyDefinition;

return MappedSuperclass::of(
    class: EmptyDefinition::class,
)->withFields(
    Field::of(property: 'field')->withColumn(definition: ''),
);
