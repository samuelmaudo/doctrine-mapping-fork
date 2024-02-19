<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\NullStrategy;

return Entity::of(
    class: NullStrategy::class,
)->withFields(
    Field::of(property: 'field', strategy: null),
);
