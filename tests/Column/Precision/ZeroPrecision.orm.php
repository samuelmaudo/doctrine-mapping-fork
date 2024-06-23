<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Precision\ZeroPrecision;

return Entity::of(
    class: ZeroPrecision::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: 0),
);
