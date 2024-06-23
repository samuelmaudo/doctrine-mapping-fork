<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Insertable\UndefinedInsertable;

return Entity::of(
    class: UndefinedInsertable::class,
)->withFields(
    Field::of(property: 'field'),
);
