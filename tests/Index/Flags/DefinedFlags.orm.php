<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Flags\DefinedFlags;

return Entity::of(
    DefinedFlags::class,
)->withIndexes(
    Index::of(flags: ['flag1', 'flag2'], fields: ['field']),
);
