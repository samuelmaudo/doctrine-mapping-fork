<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\DefinedName;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    DefinedName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(name: 'uniqueConstraint', fields: ['field']),
);
