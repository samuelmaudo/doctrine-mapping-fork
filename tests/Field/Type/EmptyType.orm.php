<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Type\EmptyType;

return Entity::of(
    class: EmptyType::class,
)->withFields(
    Field::of(property: 'field', type: ''),
);
