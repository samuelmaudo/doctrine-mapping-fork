<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\UndefinedInitialValue;

return Entity::of(
    class: UndefinedInitialValue::class,
)->withFields(
    Field::of(property: 'id', id: true)->withSequenceGenerator(sequenceName: 'sequence'),
);
