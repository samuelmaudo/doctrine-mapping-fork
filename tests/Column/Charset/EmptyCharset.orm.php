<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Charset\EmptyCharset;

return Entity::of(
    class: EmptyCharset::class,
)->withFields(
    Field::of(property: 'field')->withColumn(charset: ''),
);
