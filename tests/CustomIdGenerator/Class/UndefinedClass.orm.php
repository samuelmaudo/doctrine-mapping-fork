<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\UndefinedClass;

return Entity::of(
    class: UndefinedClass::class,
)->withFields(
    Field::of(property: 'id', id: true)->withCustomIdGenerator(),
);
