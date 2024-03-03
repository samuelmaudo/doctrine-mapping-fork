<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\EmptyClass;

return Entity::of(
    class: EmptyClass::class,
)->withFields(
    Field::of(property: 'id', id: true)->withCustomIdGenerator(class: ''),
);
