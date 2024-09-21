<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\MissingTargetEntity;

return Entity::of(
    class: MissingTargetEntity::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
    ),
);
