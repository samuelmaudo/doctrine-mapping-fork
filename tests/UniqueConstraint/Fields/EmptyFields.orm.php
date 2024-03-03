<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\EmptyFields;

return MappedSuperclass::of(
    EmptyFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: [], columns: ['column']),
);
