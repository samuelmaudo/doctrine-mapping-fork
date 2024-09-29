<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\EagerFetch;

return Entity::of(
    class: EagerFetch::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: EagerFetch::class,
        fetch: Fetch::Eager,
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: EagerFetch::class,
        fetch: 'EAGER',
    ),
);
