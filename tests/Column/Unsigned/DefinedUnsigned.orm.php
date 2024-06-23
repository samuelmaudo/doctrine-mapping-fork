<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Unsigned\DefinedUnsigned;

return Entity::of(
    class: DefinedUnsigned::class,
)->withFields(
    Field::of(property: 'id')->withColumn(unsigned: true),
    Field::of(property: 'field')->withColumn(unsigned: false),
);
