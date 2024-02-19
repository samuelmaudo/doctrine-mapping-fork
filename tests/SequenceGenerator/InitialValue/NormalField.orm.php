<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\NormalField;

return Entity::of(
    class: NormalField::class,
)->withFields(
    Field::of(property: 'field')->withSequenceGenerator(sequenceName: 'sequence', initialValue: 5),
);
