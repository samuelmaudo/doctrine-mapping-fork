<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\NonExistingClass;

return Entity::of(
    class: NonExistingClass::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true)->withCustomIdGenerator(class: 'NonExistingIdGenerator'),
);
