<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\UndefinedSequenceName;

return Entity::of(
    class: UndefinedSequenceName::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(),
);
