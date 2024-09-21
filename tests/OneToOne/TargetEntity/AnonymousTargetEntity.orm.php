<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\AnonymousTargetEntity;

$object = new class() {};

return Entity::of(
    class: AnonymousTargetEntity::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: $object::class,
    ),
);
