<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\IdentityStrategy;

return Entity::of(
    class: IdentityStrategy::class,
)->withFields(
    Field::of(property: 'id')->withGeneratedValue(strategy: Strategy::Identity),
    Field::of(property: 'field')->withGeneratedValue(strategy: 'IDENTITY'),
);
