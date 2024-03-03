<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Columns\DefinedColumn;

return Entity::of(
    DefinedColumn::class,
)->withIndexes(
    Index::of(columns: 'column'),
);
