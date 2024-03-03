<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Id\UndefinedId;

return Entity::of(
    class: UndefinedId::class,
)->withFields(
    Field::of(property: 'field'),
);
