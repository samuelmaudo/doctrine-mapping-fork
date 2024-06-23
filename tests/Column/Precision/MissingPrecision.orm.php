<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Precision\MissingPrecision;

return Entity::of(
    class: MissingPrecision::class,
)->withFields(
    Field::of(property: 'field')->withColumn(scale: 5),
);
