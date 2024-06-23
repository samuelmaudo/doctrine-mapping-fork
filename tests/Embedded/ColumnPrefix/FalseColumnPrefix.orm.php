<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix\FalseColumnPrefix;

return Entity::of(
    class: FalseColumnPrefix::class,
)->withFields(
    Embedded::of(property: 'field', columnPrefix: false),
);
