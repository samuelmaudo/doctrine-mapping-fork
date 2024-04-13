<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\CustomStrategy;

return Entity::of(
    class: CustomStrategy::class,
)->withFields(
    Id::of(property: 'id')->withGeneratedValue(strategy: Strategy::Custom),
    Id::of(property: 'field')->withGeneratedValue(strategy: 'CUSTOM'),
);
