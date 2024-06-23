<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Index\Fields\NullFields;

return MappedSuperclass::of(
    NullFields::class,
)->withIndexes(
    Index::of(fields: null, columns: ['column']),
);
