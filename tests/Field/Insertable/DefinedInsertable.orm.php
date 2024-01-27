<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Insertable\DefinedInsertable;

return Entity::of(
    class: DefinedInsertable::class,
)->withFields(
    Field::of(property: 'id', insertable: true),
    Field::of(property: 'field', insertable: false),
);
