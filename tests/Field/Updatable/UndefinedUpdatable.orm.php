<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Updatable\UndefinedUpdatable;

return Entity::of(
    class: UndefinedUpdatable::class,
)->withFields(
    Field::of(property: 'field'),
);
