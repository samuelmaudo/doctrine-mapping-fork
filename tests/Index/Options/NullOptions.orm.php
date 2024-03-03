<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Options\NullOptions;

return Entity::of(
    NullOptions::class,
)->withIndexes(
    Index::of(options: null, fields: ['field']),
);
