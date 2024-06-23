<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Column\Definition\DefinedDefinition;

return MappedSuperclass::of(
    class: DefinedDefinition::class,
)->withFields(
    Field::of(property: 'field')->withColumn(definition: 'CHAR(32) NOT NULL'),
);
