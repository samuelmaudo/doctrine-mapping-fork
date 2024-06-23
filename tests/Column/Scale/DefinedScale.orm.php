<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Scale\DefinedScale;

return Entity::of(
    class: DefinedScale::class,
)->withFields(
    Field::of(property: 'field')->withColumn(precision: 10, scale: 5),
);
