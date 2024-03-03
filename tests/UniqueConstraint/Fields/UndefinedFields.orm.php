<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\UndefinedFields;

return MappedSuperclass::of(
    UndefinedFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['column']),
);
