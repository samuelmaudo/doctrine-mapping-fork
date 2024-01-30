<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Generated\UndefinedGenerated;

return Entity::of(
    class: UndefinedGenerated::class,
)->withFields(
    Field::of(property: 'field'),
);
