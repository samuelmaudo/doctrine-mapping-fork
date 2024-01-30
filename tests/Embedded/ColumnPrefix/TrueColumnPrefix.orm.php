<?php

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\TrueColumnPrefix;

return Entity::of(
    class: TrueColumnPrefix::class,
)->withFields(
    Embedded::of(property: 'field', columnPrefix: true),
);
