<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Index\Fields\DefinedFields;

return MappedSuperclass::of(
    DefinedFields::class,
)->withIndexes(
    Index::of(fields: ['field1', 'field2']),
);
