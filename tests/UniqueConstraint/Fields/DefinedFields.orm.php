<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\DefinedFields;
use Hereldar\DoctrineMapping\UniqueConstraint;

return MappedSuperclass::of(
    DefinedFields::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field1', 'field2']),
);
