<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Precision\NegativePrecision;

return Entity::of(
    class: NegativePrecision::class,
)->withFields(
    Field::of(property: 'field', precision: -10),
);
