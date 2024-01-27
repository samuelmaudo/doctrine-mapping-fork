<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Precision\DefinedPrecision;

return Entity::of(
    class: DefinedPrecision::class,
)->withFields(
    Field::of(property: 'field', precision: 10),
);
