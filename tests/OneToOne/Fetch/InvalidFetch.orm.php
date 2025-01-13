<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\InvalidFetch;

return Entity::of(
    class: InvalidFetch::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: InvalidFetch::class,
        fetch: 'UNKNOWN',
    ),
);