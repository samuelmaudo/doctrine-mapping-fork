<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\EmptyFields;
use Hereldar\DoctrineMapping\UniqueConstraint;

return MappedSuperclass::of(
    EmptyFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: [], columns: ['column']),
);
