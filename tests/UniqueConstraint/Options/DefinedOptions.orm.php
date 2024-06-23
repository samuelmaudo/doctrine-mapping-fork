<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\DefinedOptions;
use Hereldar\DoctrineMapping\UniqueConstraint;

return Entity::of(
    DefinedOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: ['key' => 'value'], fields: ['field']),
);
