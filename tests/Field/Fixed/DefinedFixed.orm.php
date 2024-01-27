<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Fixed\DefinedFixed;

return Entity::of(
    class: DefinedFixed::class,
)->withFields(
    Field::of(property: 'id', fixed: true),
    Field::of(property: 'field', fixed: false),
);
