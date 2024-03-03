<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Options\EmptyOption;

return Entity::of(
    EmptyOption::class,
)->withIndexes(
    Index::of(options: ['' => 'value']),
);
