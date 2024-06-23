<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Precision\UndefinedPrecision;

return Entity::of(
    class: UndefinedPrecision::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
