<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Generated\InvalidGenerated;

return Entity::of(
    class: InvalidGenerated::class,
)->withFields(
    Field::of(property: 'field', generated: 'UNKNOWN'),
);
