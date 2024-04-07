<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\CustomStrategy;

return Entity::of(
    class: CustomStrategy::class,
)->withFields(
    Field::of(property: 'id')->withGeneratedValue(strategy: Strategy::Custom),
    Field::of(property: 'field')->withGeneratedValue(strategy: 'CUSTOM'),
);
