<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\DefinedColumns;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    DefinedColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['column1', 'column2']),
);
