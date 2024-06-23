<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Fixed\DefinedFixed;

return Entity::of(
    class: DefinedFixed::class,
)->withFields(
    Field::of(property: 'id')->withColumn(fixed: true),
    Field::of(property: 'field')->withColumn(fixed: false),
);
