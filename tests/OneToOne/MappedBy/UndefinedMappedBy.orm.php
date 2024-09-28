<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\UndefinedMappedBy;

return Entity::of(
    class: UndefinedMappedBy::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: UndefinedMappedBy::class,
    ),
);
