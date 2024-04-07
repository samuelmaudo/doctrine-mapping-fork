<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\AutoStrategy;

return Entity::of(
    class: AutoStrategy::class,
)->withFields(
    Field::of(property: 'id')->withGeneratedValue(strategy: Strategy::Auto),
    Field::of(property: 'field')->withGeneratedValue(strategy: 'AUTO'),
);
