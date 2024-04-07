<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Fixed\UndefinedFixed;

return Entity::of(
    class: UndefinedFixed::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
