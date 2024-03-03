<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Flags\InvalidFlag;

return Entity::of(
    InvalidFlag::class,
)->withIndexes(
    Index::of(flags: ['flag1', 'flag2', 42]),
);
