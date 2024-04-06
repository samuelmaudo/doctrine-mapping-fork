<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\InvalidIdGenerator;

return Entity::of(
    class: ExistingClass::class,
)->withFields(
    Field::of(property: 'id', id: true)->withCustomIdGenerator(class: InvalidIdGenerator::class),
);
