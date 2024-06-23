<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\NoneStrategy;

return Entity::of(
    class: NoneStrategy::class,
)->withFields(
    Id::of(property: 'id')->withGeneratedValue(strategy: Strategy::None),
    Id::of(property: 'field')->withGeneratedValue(strategy: 'NONE'),
);
