<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\DefinedNullable;

return Entity::of(
    class: DefinedNullable::class,
)->withFields(
    Field::of(property: 'id', nullable: false),
    Field::of(property: 'field', nullable: true),
);
