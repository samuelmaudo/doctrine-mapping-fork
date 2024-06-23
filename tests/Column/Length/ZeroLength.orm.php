<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Length\ZeroLength;

return Entity::of(
    class: ZeroLength::class,
)->withFields(
    Field::of(property: 'field')->withColumn(length: 0),
);
