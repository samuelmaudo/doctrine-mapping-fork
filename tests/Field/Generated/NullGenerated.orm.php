<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Generated\NullGenerated;

return Entity::of(
    class: NullGenerated::class,
)->withFields(
    Field::of(property: 'field', generated: null),
);
