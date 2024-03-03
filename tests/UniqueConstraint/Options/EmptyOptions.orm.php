<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\EmptyOptions;

return Entity::of(
    EmptyOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: [], fields: ['field']),
);
