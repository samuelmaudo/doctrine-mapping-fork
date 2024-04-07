<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\InvalidStrategy;

return Entity::of(
    class: InvalidStrategy::class,
)->withFields(
    Field::of(property: 'field')->withGeneratedValue(strategy: 'UNKNOWN'),
);
