<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\UndefinedFields;
use Hereldar\DoctrineMapping\UniqueConstraint;

return MappedSuperclass::of(
    UndefinedFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['column']),
);
