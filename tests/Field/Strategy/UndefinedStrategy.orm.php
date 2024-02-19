<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\UndefinedStrategy;

return Entity::of(
    class: UndefinedStrategy::class,
)->withFields(
    Field::of(property: 'field'),
);
