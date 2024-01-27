<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Unsigned\UndefinedUnsigned;

return Entity::of(
    class: UndefinedUnsigned::class,
)->withFields(
    Field::of(property: 'field'),
);
