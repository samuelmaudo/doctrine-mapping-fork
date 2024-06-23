<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\InvalidOption;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    InvalidOption::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: [42 => 'value']),
);
