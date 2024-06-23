<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\NonExistingClass;

return Entity::of(
    class: NonExistingClass::class,
)->withFields(
    Id::of(property: 'id')->withCustomIdGenerator(class: 'NonExistingIdGenerator'),
);
