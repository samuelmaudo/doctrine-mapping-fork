<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\AnonymousClass;

$object = new class {};

return Entity::of(
    class: AnonymousClass::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true)->withCustomIdGenerator(class: $object::class),
);
