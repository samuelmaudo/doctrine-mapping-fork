<?php

use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\CustomStrategy;

return Entity::of(
    class: CustomStrategy::class,
)->withFields(
    Field::of(property: 'id', strategy: Strategy::Custom),
    Field::of(property: 'field', strategy: 'CUSTOM'),
);
