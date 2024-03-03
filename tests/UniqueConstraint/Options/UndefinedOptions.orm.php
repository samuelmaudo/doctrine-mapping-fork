<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\UndefinedOptions;

return Entity::of(
    UndefinedOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field']),
);
