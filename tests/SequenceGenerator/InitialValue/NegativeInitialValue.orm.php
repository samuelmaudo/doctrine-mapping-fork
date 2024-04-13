<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\NegativeInitialValue;

return Entity::of(
    class: NegativeInitialValue::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence', initialValue: -5),
);
