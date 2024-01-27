<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Length\UndefinedLength;

return Entity::of(
    class: UndefinedLength::class,
)->withFields(
    Field::of(property: 'field'),
);
