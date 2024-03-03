<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\DefinedNullableId;

return Entity::of(
    class: DefinedNullableId::class,
)->withFields(
    Field::of(property: 'id', id: true, nullable: true),
);
