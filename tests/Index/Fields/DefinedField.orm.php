<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Index;
use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\Index\Fields\DefinedField;

return MappedSuperclass::of(
    DefinedField::class,
)->withIndexes(
    Index::of(fields: 'field'),
);
