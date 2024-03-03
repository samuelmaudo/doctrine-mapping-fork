<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\InvalidField;

return MappedSuperclass::of(
    InvalidField::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field1', 'field2', 42]),
);
