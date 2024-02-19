<?php

use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Strategy\SequenceStrategy;

return Entity::of(
    class: SequenceStrategy::class,
)->withFields(
    Field::of(property: 'id', strategy: Strategy::Sequence),
    Field::of(property: 'field', strategy: 'SEQUENCE'),
);
