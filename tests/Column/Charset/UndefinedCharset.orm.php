<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Charset\UndefinedCharset;

return Entity::of(
    class: UndefinedCharset::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
