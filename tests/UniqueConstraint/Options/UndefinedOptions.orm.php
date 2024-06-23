<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\UndefinedOptions;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    UndefinedOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(fields: ['field']),
);
