<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\EmptyName;

return Entity::of(
    EmptyName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(name: '', fields: ['field']),
);
