<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Name\UndefinedName;

return Entity::of(
    UndefinedName::class,
)->withIndexes(
    Index::of(fields: ['field']),
);
