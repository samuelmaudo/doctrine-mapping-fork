<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\UndefinedInitialValue;

return Entity::of(
    class: UndefinedInitialValue::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence'),
);
