<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Fields\EmptyField;
use Hereldar\DoctrineMapping\UniqueConstraint;

return MappedSuperclass::of(
    EmptyField::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field1', 'field2', '']),
);
