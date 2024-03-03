<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Id\DefinedId;

return Entity::of(
    class: DefinedId::class,
)->withFields(
    Field::of(property: 'id', id: true),
    Field::of(property: 'field', id: false),
);
