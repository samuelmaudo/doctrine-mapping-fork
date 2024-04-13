<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\DefinedInitialValue;

return Entity::of(
    class: DefinedInitialValue::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence', initialValue: 5),
);
