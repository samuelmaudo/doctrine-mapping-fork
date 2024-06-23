<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\UndefinedColumns;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    UndefinedColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field']),
);
