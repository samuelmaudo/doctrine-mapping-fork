<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\NullFields;
use Hereldar\DoctrineMapping\UniqueConstraint;

return MappedSuperclass::of(
    NullFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: null, columns: ['column']),
);
