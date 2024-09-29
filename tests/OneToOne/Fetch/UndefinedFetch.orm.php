<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\UndefinedFetch;

return Entity::of(
    class: UndefinedFetch::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: UndefinedFetch::class,
    ),
);
