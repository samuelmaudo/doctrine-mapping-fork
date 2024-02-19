<?php

use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\IdentityStrategy;

return Entity::of(
    class: IdentityStrategy::class,
)->withFields(
    Field::of(property: 'id', strategy: Strategy::Identity),
    Field::of(property: 'field', strategy: 'IDENTITY'),
);
