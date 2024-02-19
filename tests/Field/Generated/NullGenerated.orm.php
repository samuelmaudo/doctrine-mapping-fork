<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Generated\NullGenerated;

return Entity::of(
    class: NullGenerated::class,
)->withFields(
    Field::of(property: 'field', generated: null),
);
