<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Columns\InvalidColumn;

return Entity::of(
    InvalidColumn::class,
)->withIndexes(
    Index::of(columns: ['column1', 'column2', 42]),
);
