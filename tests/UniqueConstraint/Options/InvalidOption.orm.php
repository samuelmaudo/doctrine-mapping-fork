<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\InvalidOption;

return Entity::of(
    InvalidOption::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: [42 => 'value']),
);
