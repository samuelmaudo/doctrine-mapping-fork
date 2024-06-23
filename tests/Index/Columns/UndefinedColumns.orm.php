<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Columns\UndefinedColumns;

return Entity::of(
    UndefinedColumns::class,
)->withIndexes(
    Index::of(fields: ['field']),
);
