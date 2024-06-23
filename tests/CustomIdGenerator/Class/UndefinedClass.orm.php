<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\UndefinedClass;

return Entity::of(
    class: UndefinedClass::class,
)->withFields(
    Id::of(property: 'id')->withCustomIdGenerator(),
);
