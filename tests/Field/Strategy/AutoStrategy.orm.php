<?php

use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\AutoStrategy;

return Entity::of(
    class: AutoStrategy::class,
)->withFields(
    Field::of(property: 'id', strategy: Strategy::Auto),
    Field::of(property: 'field', strategy: 'AUTO'),
);
