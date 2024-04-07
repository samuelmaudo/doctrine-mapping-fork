<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Precision\NegativePrecision;

return Entity::of(
    class: NegativePrecision::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: -10),
);
