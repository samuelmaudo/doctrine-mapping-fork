<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Collation\EmptyCollation;

return Entity::of(
    class: EmptyCollation::class,
)->withFields(
    Field::of(property: 'field')->withColumn(collation: ''),
);
