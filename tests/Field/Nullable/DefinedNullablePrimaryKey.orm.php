<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Nullable\DefinedNullablePrimaryKey;

return Entity::of(
    class: DefinedNullablePrimaryKey::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true, nullable: true),
);
