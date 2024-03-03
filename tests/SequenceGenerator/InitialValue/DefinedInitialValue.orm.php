<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\DefinedInitialValue;

return Entity::of(
    class: DefinedInitialValue::class,
)->withFields(
    Field::of(property: 'id', id: true)->withSequenceGenerator(sequenceName: 'sequence', initialValue: 5),
);
