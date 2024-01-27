<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Scale\NegativeScale;

return Entity::of(
    class: NegativeScale::class,
)->withFields(
    Field::of(property: 'field', precision: 10, scale: -5),
);
