<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\DefinedSequenceName;

return Entity::of(
    class: DefinedSequenceName::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true)->withSequenceGenerator(sequenceName: 'sequence'),
);
