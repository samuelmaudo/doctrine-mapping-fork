<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\EmptyColumn;

return Entity::of(
    EmptyColumn::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['column1', 'column2', '']),
);
