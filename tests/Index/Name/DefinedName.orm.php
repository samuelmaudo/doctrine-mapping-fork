<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Name\DefinedName;

return Entity::of(
    DefinedName::class,
)->withIndexes(
    Index::of(name: 'index', fields: ['field']),
);
