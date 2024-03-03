<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Columns\NullColumns;

return Entity::of(
    NullColumns::class,
)->withIndexes(
    Index::of(columns: null, fields: ['field']),
);
