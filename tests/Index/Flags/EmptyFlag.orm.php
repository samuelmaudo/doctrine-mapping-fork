<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Flags\EmptyFlag;

return Entity::of(
    EmptyFlag::class,
)->withIndexes(
    Index::of(flags: ['flag1', 'flag2', '']),
);
