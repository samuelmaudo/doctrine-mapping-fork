<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Scale\UndefinedScale;

return Entity::of(
    class: UndefinedScale::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: 10),
);
