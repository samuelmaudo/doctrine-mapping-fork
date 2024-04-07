<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Precision\DefinedPrecision;

return Entity::of(
    class: DefinedPrecision::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: 10),
);
