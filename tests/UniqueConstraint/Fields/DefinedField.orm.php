<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\DefinedField;

return MappedSuperclass::of(
    DefinedField::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: 'field'),
);
