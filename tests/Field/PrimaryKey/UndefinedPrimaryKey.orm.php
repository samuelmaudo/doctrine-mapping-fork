<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\PrimaryKey\UndefinedPrimaryKey;

return Entity::of(
    class: UndefinedPrimaryKey::class,
)->withFields(
    Field::of(property: 'field'),
);
