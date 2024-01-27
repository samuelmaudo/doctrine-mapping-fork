<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Type\DefinedType;

return Entity::of(
    class: DefinedType::class,
)->withFields(
    Field::of(property: 'id', type: 'integer'),
    Field::of(property: 'field', type: 'json'),
);
