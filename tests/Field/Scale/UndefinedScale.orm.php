<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Scale\UndefinedScale;

return Entity::of(
    class: UndefinedScale::class,
)->withFields(
    Field::of(property: 'field', precision: 10),
);
