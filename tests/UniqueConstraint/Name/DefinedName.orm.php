<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Name\DefinedName;

return Entity::of(
    DefinedName::class,
)->withUniqueConstraints(
    UniqueConstraint::of(name: 'uniqueConstraint', fields: ['field']),
);
