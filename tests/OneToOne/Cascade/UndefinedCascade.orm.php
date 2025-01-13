<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Cascade\UndefinedCascade;

return Entity::of(
    class: UndefinedCascade::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: UndefinedCascade::class,
    ),
);
