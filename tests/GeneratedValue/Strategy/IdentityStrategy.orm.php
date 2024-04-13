<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\IdentityStrategy;

return Entity::of(
    class: IdentityStrategy::class,
)->withFields(
    Id::of(property: 'id')->withGeneratedValue(strategy: Strategy::Identity),
    Id::of(property: 'field')->withGeneratedValue(strategy: 'IDENTITY'),
);
