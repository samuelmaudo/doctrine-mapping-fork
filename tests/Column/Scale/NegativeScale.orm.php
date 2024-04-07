<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Scale\NegativeScale;

return Entity::of(
    class: NegativeScale::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: 10, scale: -5),
);
