<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\EmptyColumns;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    EmptyColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: [], fields: ['field']),
);
