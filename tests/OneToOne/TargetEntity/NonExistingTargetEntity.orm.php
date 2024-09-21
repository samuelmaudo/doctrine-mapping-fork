<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\NonExistingTargetEntity;

return Entity::of(
    class: NonExistingTargetEntity::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: 'NonExisting',
    ),
);
