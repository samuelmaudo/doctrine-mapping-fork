<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Precision\UndefinedPrecision;

return Entity::of(
    class: UndefinedPrecision::class,
)->withFields(
    Field::of(property: 'field'),
);
