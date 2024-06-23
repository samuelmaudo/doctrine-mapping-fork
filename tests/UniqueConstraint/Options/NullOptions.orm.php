<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\NullOptions;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    NullOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: null, fields: ['field']),
);
