<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Collation\UndefinedCollation;

return Entity::of(
    class: UndefinedCollation::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
