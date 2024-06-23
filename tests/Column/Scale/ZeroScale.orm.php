<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Scale\ZeroScale;

return Entity::of(
    class: ZeroScale::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: 10, scale: 0),
);
