<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\UndefinedName;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    UndefinedName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field']),
);
