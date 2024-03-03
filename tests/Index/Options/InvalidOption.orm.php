<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Options\InvalidOption;

return Entity::of(
    InvalidOption::class,
)->withIndexes(
    Index::of(options: [42 => 'value']),
);
