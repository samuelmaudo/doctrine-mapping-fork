<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Collation\UndefinedCollation;

return Entity::of(
    class: UndefinedCollation::class,
)->withFields(
    Field::of(property: 'field'),
);
