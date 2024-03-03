<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\NegativeInitialValue;

return Entity::of(
    class: NegativeInitialValue::class,
)->withFields(
    Field::of(property: 'id', id: true)->withSequenceGenerator(sequenceName: 'sequence', initialValue: -5),
);
