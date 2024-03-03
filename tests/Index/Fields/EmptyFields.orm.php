<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Fields\EmptyFields;

return MappedSuperclass::of(
    EmptyFields::class,
)->withIndexes(
    Index::of(fields: [], columns: ['column']),
);
