<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\PrimaryKey\DefinedPrimaryKey;

return Entity::of(
    class: DefinedPrimaryKey::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true),
    Field::of(property: 'field', primaryKey: false),
);
