<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Index\Fields\UndefinedFields;

return MappedSuperclass::of(
    UndefinedFields::class,
)->withIndexes(
    Index::of(columns: ['column']),
);
