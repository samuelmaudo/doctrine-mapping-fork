<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Flags\NullFlags;

return Entity::of(
    NullFlags::class,
)->withIndexes(
    Index::of(flags: null, fields: ['field']),
);
