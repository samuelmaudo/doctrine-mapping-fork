<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Updatable\DefinedUpdatable;

return Entity::of(
    class: DefinedUpdatable::class,
)->withFields(
    Field::of(property: 'id', updatable: true),
    Field::of(property: 'field', updatable: false),
);
