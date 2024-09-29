<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\OneToOne;
use Hereldar\DoctrineMapping\Tests\OneToOne\Fetch\ExtraLazyFetch;

return Entity::of(
    class: ExtraLazyFetch::class,
)->withAssociations(
    OneToOne::of(
        property: 'association1',
        targetEntity: ExtraLazyFetch::class,
        fetch: Fetch::ExtraLazy,
    ),
    OneToOne::of(
        property: 'association2',
        targetEntity: ExtraLazyFetch::class,
        fetch: 'EXTRA_LAZY',
    ),
);
