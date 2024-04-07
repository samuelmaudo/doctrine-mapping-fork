<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Collation\DefinedCollation;

return Entity::of(
    class: DefinedCollation::class,
)->withFields(
    Field::of(property: 'field')->withColumn(collation: 'latin1_spanish_ci'),
);
