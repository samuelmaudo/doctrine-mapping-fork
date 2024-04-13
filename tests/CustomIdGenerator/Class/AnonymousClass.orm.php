<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\AnonymousClass;

$object = new class {};

return Entity::of(
    class: AnonymousClass::class,
)->withFields(
    Id::of(property: 'id')->withCustomIdGenerator(class: $object::class),
);
