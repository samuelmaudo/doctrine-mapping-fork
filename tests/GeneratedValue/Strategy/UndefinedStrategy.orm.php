<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\UndefinedStrategy;

return Entity::of(
    class: UndefinedStrategy::class,
)->withFields(
    Field::of(property: 'field')->withGeneratedValue(),
);
