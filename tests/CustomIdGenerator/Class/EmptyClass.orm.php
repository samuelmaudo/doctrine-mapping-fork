<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\EmptyClass;

return Entity::of(
    class: EmptyClass::class,
)->withFields(
    Id::of(property: 'id')->withCustomIdGenerator(class: ''),
);
