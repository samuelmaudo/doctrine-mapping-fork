<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\DefinedFields;

return MappedSuperclass::of(
    DefinedFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field1', 'field2']),
);
