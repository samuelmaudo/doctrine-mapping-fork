<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Tests\Field\Type\UndefinedType;

return Embeddable::of(
    class: UndefinedType::class,
)->withFields(
    Field::of(property: 'field'),
);
