<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Charset\UndefinedCharset;

return Entity::of(
    class: UndefinedCharset::class,
)->withFields(
    Field::of(property: 'field'),
);
