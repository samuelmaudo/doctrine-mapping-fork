<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Type\EmptyType;

return Embeddable::of(
    class: EmptyType::class,
)->withFields(
    Field::of(property: 'field', type: ''),
);
