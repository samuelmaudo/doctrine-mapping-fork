<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Options\EmptyOptions;

return Entity::of(
    EmptyOptions::class,
)->withIndexes(
    Index::of(options: [], fields: ['field']),
);
