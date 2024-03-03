<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\EmptyOption;

return Entity::of(
    EmptyOption::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: ['' => 'value']),
);
