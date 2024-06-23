<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Insertable\DefinedInsertable;

return Entity::of(
    class: DefinedInsertable::class,
)->withFields(
    Field::of(property: 'id', insertable: true),
    Field::of(property: 'field', insertable: false),
);
