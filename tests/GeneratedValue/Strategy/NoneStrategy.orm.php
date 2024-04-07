<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\NoneStrategy;

return Entity::of(
    class: NoneStrategy::class,
)->withFields(
    Field::of(property: 'id')->withGeneratedValue(strategy: Strategy::None),
    Field::of(property: 'field')->withGeneratedValue(strategy: 'NONE'),
);
