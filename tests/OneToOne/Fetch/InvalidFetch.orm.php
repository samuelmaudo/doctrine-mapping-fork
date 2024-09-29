<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\EagerFetch;

return Entity::of(
    class: EagerFetch::class,
)->withAssociations(
    OneToOne::of(
        property: 'association',
        targetEntity: EagerFetch::class,
        fetch: 'UNKNOWN',
    ),
);
