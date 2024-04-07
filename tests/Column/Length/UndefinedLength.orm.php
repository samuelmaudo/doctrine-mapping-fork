<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Length\UndefinedLength;

return Entity::of(
    class: UndefinedLength::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
