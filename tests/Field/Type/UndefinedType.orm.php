<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Type\UndefinedType;

return Entity::of(
    class: UndefinedType::class,
)->withFields(
    Field::of(property: 'field'),
);
