<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Fields\InvalidField;

return MappedSuperclass::of(
    InvalidField::class,
)->withIndexes(
    Index::of(fields: ['field1', 'field2', 42]),
);
