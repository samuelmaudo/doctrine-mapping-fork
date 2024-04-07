<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\GeneratedValue\Strategy\SequenceStrategy;

return Entity::of(
    class: SequenceStrategy::class,
)->withFields(
    Field::of(property: 'id')->withGeneratedValue(strategy: Strategy::Sequence),
    Field::of(property: 'field')->withGeneratedValue(strategy: 'SEQUENCE'),
);
