<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\ExistingAssociation;
use Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy\NonExistingMappedBy;

return Entity::of(
    class: NonExistingMappedBy::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: ExistingAssociation::class,
        mappedBy: 'nonExistingField',
    ),
);
