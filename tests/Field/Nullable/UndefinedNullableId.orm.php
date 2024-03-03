<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\UndefinedNullableId;

return Entity::of(
    class: UndefinedNullableId::class,
)->withFields(
    Field::of(property: 'id', id: true),
);
