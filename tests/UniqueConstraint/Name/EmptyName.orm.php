<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\EmptyName;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    EmptyName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(name: '', fields: ['field']),
);
