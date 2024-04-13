<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\AutoStrategy;

return Entity::of(
    class: AutoStrategy::class,
)->withFields(
    Id::of(property: 'id')->withGeneratedValue(strategy: Strategy::Auto),
    Id::of(property: 'field')->withGeneratedValue(strategy: 'AUTO'),
);
