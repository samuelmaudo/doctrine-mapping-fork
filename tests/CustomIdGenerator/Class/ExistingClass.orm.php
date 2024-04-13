<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingClass;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingIdGenerator;

return Entity::of(
    class: ExistingClass::class,
)->withFields(
    Id::of(property: 'id')->withCustomIdGenerator(class: ExistingIdGenerator::class),
);
