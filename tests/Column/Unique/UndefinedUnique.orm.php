<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Unique\UndefinedUnique;

return Entity::of(
    class: UndefinedUnique::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
