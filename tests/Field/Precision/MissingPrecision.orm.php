<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Precision\MissingPrecision;

return Entity::of(
    class: MissingPrecision::class,
)->withFields(
    Field::of(property: 'field', scale: 5),
);
