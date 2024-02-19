<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\InvalidStrategy;

return Entity::of(
    class: InvalidStrategy::class,
)->withFields(
    Field::of(property: 'field', strategy: 'UNKNOWN'),
);
