<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity\EmptyTargetEntity;

return Entity::of(
    class: EmptyTargetEntity::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: '',
    ),
);
