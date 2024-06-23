<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Name\NullName;

return Entity::of(
    NullName::class,
)->withIndexes(
    Index::of(name: null, fields: ['field']),
);
