<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Scale\ScaleGreaterThanPrecision;

return Entity::of(
    class: ScaleGreaterThanPrecision::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: 5, scale: 10),
);
