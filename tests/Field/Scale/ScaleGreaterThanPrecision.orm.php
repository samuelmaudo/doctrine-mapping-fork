<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Scale\ScaleGreaterThanPrecision;

return Entity::of(
    class: ScaleGreaterThanPrecision::class,
)->withFields(
    Field::of(property: 'field', precision: 5, scale: 10),
);
