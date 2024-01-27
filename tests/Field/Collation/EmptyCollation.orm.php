<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Collation\EmptyCollation;

return Entity::of(
    class: EmptyCollation::class,
)->withFields(
    Field::of(property: 'field', collation: ''),
);
