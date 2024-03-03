<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\Tests\Index\Fields\EmptyField;

return MappedSuperclass::of(
    EmptyField::class,
)->withIndexes(
    Index::of(fields: ['field1', 'field2', '']),
);
