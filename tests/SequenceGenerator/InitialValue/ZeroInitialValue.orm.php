<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\ZeroInitialValue;

return Entity::of(
    class: ZeroInitialValue::class,
)->withFields(
    Field::of(property: 'id', id: true)->withSequenceGenerator(sequenceName: 'sequence', initialValue: 0),
);
