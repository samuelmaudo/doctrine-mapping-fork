<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Fixed\UndefinedFixed;

return Entity::of(
    class: UndefinedFixed::class,
)->withFields(
    Field::of(property: 'field'),
);
