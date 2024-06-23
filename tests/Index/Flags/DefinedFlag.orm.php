<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Flags\DefinedFlag;

return Entity::of(
    DefinedFlag::class,
)->withIndexes(
    Index::of(flags: 'flag', fields: ['field']),
);
