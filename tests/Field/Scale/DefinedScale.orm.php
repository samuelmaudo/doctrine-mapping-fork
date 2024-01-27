<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Scale\DefinedScale;

return Entity::of(
    class: DefinedScale::class,
)->withFields(
    Field::of(property: 'field', precision: 10, scale: 5),
);
