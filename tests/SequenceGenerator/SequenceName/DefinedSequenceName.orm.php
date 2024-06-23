<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Tests\SequenceGenerator\SequenceName\DefinedSequenceName;

return Entity::of(
    class: DefinedSequenceName::class,
)->withFields(
    Id::of(property: 'id')->withSequenceGenerator(sequenceName: 'sequence'),
);
