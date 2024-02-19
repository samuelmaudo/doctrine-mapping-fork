<?php

use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Generated\InsertGenerated;

return Entity::of(
    class: InsertGenerated::class,
)->withFields(
    Field::of(property: 'id', generated: Generated::Insert),
    Field::of(property: 'field', generated: 'INSERT'),
);
