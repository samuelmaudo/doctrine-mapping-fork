<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\NullColumns;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    NullColumns::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: null, fields: ['field']),
);
