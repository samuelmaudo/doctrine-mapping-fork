<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Flags\EmptyFlags;

return Entity::of(
    EmptyFlags::class,
)->withIndexes(
    Index::of(flags: [], fields: ['field']),
);
