<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\NullMappedBy;

return Entity::of(
    class: NullMappedBy::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: NullMappedBy::class,
        mappedBy: null,
    ),
);
