<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Charset\DefinedCharset;

return Entity::of(
    class: DefinedCharset::class,
)->withFields(
    Field::of(property: 'field', charset: 'gb2312'),
);
