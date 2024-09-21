<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\UndefinedTargetEntity;

return Entity::of(
    class: UndefinedTargetEntity::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
    ),
);
