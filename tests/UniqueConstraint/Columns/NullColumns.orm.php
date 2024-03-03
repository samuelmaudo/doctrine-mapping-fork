<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\NullColumns;

return Entity::of(
    NullColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: null, fields: ['field']),
);
