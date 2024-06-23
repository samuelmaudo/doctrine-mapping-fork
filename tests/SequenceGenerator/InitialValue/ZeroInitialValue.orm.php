<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\InitialValue\ZeroInitialValue;

return Entity::of(
    class: ZeroInitialValue::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence', initialValue: 0),
);
