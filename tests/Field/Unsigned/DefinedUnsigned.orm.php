<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Unsigned\DefinedUnsigned;

return Entity::of(
    class: DefinedUnsigned::class,
)->withFields(
    Field::of(property: 'id', unsigned: true),
    Field::of(property: 'field', unsigned: false),
);
