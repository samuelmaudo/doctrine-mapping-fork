<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Column\Definition\UndefinedDefinition;

return MappedSuperclass::of(
    class: UndefinedDefinition::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
