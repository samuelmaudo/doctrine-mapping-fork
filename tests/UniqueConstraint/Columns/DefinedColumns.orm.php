<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\DefinedColumns;

return Entity::of(
    DefinedColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['column1', 'column2']),
);
