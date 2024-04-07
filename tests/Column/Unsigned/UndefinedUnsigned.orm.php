<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Unsigned\UndefinedUnsigned;

return Entity::of(
    class: UndefinedUnsigned::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
