<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\NullName;

return Entity::of(
    NullName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(name: null, fields: ['field']),
);
