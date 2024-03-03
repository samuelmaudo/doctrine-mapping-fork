<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\UndefinedName;

return Entity::of(
    UndefinedName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field']),
);
