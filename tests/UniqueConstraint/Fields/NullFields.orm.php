<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\NullFields;

return MappedSuperclass::of(
    NullFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: null, columns: ['column']),
);
