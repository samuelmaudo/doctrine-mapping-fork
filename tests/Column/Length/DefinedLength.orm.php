<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Length\DefinedLength;

return Entity::of(
    class: DefinedLength::class,
)->withFields(
    Field::of(property: 'field')->withColumn(length: 5),
);
