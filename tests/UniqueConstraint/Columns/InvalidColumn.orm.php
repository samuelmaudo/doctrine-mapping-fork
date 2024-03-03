<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\InvalidColumn;

return Entity::of(
    InvalidColumn::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['column1', 'column2', 42]),
);
