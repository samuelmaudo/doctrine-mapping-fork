<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\AllocationSize\NegativeAllocationSize;

return Entity::of(
    class: NegativeAllocationSize::class,
)->withFields(
    Field::of(property: 'id', primaryKey: true)->withSequenceGenerator(sequenceName: 'sequence', allocationSize: -5),
);
