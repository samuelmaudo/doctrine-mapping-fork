<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Name\EmptyName;

return Entity::of(
    EmptyName::class,
)->withIndexes(
    Index::of(name: '', fields: ['field']),
);
