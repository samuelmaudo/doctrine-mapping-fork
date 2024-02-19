<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\ZeroAllocationSize;

return Entity::of(
    class: ZeroAllocationSize::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true)->withSequenceGenerator(sequenceName: 'sequence', allocationSize: 0),
);
