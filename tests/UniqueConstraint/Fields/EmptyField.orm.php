<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\EmptyField;

return MappedSuperclass::of(
    EmptyField::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field1', 'field2', '']),
);
