<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\DefinedAllocationSize;

return Entity::of(
    class: DefinedAllocationSize::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence', allocationSize: 5),
);
