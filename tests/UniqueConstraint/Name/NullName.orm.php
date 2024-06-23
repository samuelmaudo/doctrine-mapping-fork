<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\NullName;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    NullName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(name: null, fields: ['field']),
);
