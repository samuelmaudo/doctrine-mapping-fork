<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Scale\ZeroScale;

return Entity::of(
    class: ZeroScale::class,
)->withFields(
    Field::of(property: 'field', precision: 10, scale: 0),
);
