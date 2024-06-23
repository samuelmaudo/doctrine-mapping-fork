<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\EmptyOptions;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    EmptyOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: [], fields: ['field']),
);
