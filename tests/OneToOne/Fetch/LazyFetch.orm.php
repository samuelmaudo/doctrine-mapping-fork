<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\LazyFetch;

return Entity::of(
    class: LazyFetch::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: LazyFetch::class,
        fetch: Fetch::Lazy,
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: LazyFetch::class,
        fetch: 'LAZY',
    ),
);
