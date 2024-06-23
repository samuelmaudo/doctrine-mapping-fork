<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Columns\EmptyColumns;

return Entity::of(
    EmptyColumns::class,
)->withIndexes(
    Index::of(columns: [], fields: ['field']),
);
