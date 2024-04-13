<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\UndefinedStrategy;

return Entity::of(
    class: UndefinedStrategy::class,
)->withFields(
    Id::of(property: 'field')->withGeneratedValue(),
);
