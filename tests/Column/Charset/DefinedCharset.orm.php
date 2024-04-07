<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Charset\DefinedCharset;

return Entity::of(
    class: DefinedCharset::class,
)->withFields(
    Field::of(property: 'field')->withColumn(charset: 'gb2312'),
);
