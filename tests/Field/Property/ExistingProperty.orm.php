<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Property\ExistingProperty;

return Entity::of(
    class: ExistingProperty::class,
)->withFields(
    Field::of(property: 'field'),
);
