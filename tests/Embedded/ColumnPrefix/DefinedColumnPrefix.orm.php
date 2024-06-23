<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\DefinedColumnPrefix;

return Entity::of(
    class: DefinedColumnPrefix::class,
)->withFields(
    Embedded::of(property: 'field', columnPrefix: 'prefix_'),
);
