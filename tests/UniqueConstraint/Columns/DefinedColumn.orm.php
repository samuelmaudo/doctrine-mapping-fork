<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\DefinedColumn;

return Entity::of(
    DefinedColumn::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: 'column'),
);
