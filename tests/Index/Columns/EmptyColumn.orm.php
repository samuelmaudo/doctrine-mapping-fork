<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Columns\EmptyColumn;

return Entity::of(
    EmptyColumn::class,
)->withIndexes(
    Index::of(columns: ['column1', 'column2', '']),
);
