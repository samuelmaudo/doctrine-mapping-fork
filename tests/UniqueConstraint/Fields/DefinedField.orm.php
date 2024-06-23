<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\DefinedField;
use Hereldar\DoctrineMapping\UniqueConstraint;

return MappedSuperclass::of(
    DefinedField::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: 'field'),
);
