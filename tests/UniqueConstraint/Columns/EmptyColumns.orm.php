<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\EmptyColumns;

return Entity::of(
    EmptyColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: [], fields: ['field']),
);
