<?php

use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\NoneStrategy;

return Entity::of(
    class: NoneStrategy::class,
)->withFields(
    Field::of(property: 'id', strategy: Strategy::None),
    Field::of(property: 'field', strategy: 'NONE'),
);
