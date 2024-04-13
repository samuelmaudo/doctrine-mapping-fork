<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\NegativeAllocationSize;

return Entity::of(
    class: NegativeAllocationSize::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence', allocationSize: -5),
);
