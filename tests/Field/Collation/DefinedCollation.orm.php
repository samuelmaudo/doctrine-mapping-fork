<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Collation\DefinedCollation;

return Entity::of(
    class: DefinedCollation::class,
)->withFields(
    Field::of(property: 'field', collation: 'latin1_spanish_ci'),
);
