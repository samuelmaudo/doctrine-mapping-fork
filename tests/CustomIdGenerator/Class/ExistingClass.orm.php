<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingIdGenerator;

return Entity::of(
    class: ExistingClass::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true)->withCustomIdGenerator(class: ExistingIdGenerator::class),
);
