<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Columns\DefinedColumn;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    DefinedColumn::class,
)->withUniqueConstraints(
    UniqueConstraint::of(columns: 'column'),
);
