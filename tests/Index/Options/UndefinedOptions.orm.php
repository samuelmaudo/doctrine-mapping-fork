<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Options\UndefinedOptions;

return Entity::of(
    UndefinedOptions::class,
)->withIndexes(
    Index::of(fields: ['field']),
);
