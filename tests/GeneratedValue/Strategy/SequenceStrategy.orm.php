<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\SequenceStrategy;

return Entity::of(
    class: SequenceStrategy::class,
)->withFields(
    Id::of(property: 'id')->withGeneratedValue(strategy: Strategy::Sequence),
    Id::of(property: 'field')->withGeneratedValue(strategy: 'SEQUENCE'),
);
