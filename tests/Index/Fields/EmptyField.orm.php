<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Index\Fields\EmptyField;

return MappedSuperclass::of(
    EmptyField::class,
)->withIndexes(
    Index::of(fields: ['field1', 'field2', '']),
);
