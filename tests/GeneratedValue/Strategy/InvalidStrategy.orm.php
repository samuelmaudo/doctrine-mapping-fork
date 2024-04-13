<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\InvalidStrategy;

return Entity::of(
    class: InvalidStrategy::class,
)->withFields(
    Id::of(property: 'field')->withGeneratedValue(strategy: 'UNKNOWN'),
);
