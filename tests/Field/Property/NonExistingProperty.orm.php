<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Property\NonExistingProperty;

return Entity::of(
    class: NonExistingProperty::class,
)->withFields(
    Field::of(property: 'field'),
);
