<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\NullOptions;

return Entity::of(
    NullOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: null, fields: ['field']),
);
