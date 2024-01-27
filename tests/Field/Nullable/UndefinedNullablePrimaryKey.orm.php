<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\UndefinedNullablePrimaryKey;

return Entity::of(
    class: UndefinedNullablePrimaryKey::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true),
);
