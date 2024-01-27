<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Precision\ZeroPrecision;

return Entity::of(
    class: ZeroPrecision::class,
)->withFields(
    Field::of(property: 'field', precision: 0),
);
