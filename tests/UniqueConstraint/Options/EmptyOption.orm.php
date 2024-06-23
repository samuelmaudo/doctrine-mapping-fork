<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\EmptyOption;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    EmptyOption::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: ['' => 'value']),
);
