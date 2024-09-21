<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\ExistingAssociation;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\ExistingTargetEntity;

return Entity::of(
    class: ExistingTargetEntity::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: ExistingAssociation::class,
    ),
);
