<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\EmptySequenceName;

return Entity::of(
    class: EmptySequenceName::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: ''),
);
