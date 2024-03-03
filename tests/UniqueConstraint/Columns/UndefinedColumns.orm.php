<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\UndefinedColumns;

return Entity::of(
    UndefinedColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field']),
);
