<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\ZeroAllocationSize;

return Entity::of(
    class: ZeroAllocationSize::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence', allocationSize: 0),
);
