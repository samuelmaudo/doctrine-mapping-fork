<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\UndefinedSequenceName;

return Entity::of(
    class: UndefinedSequenceName::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true)->withSequenceGenerator(),
);
