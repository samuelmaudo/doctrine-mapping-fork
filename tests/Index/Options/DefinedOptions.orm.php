<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Options\DefinedOptions;

return Entity::of(
    DefinedOptions::class,
)->withIndexes(
    Index::of(options: ['key' => 'value'], fields: ['field']),
);
