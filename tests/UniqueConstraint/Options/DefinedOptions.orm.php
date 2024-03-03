<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\UniqueConstraint;
use Hereldar\DoctrineMapping\Tests\UniqueConstraint\Options\DefinedOptions;

return Entity::of(
    DefinedOptions::class,
)->withUniqueConstraints(
    UniqueConstraint::of(options: ['key' => 'value'], fields: ['field']),
);
