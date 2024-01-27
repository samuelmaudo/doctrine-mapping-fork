<?php

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\EmptyColumnPrefix;

return Entity::of(
    class: EmptyColumnPrefix::class,
)->withFields(
    Embedded::of(property: 'field', columnPrefix: ''),
);
