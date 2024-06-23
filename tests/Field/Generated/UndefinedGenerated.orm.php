<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Generated\UndefinedGenerated;

return Entity::of(
    class: UndefinedGenerated::class,
)->withFields(
    Field::of(property: 'field'),
);
