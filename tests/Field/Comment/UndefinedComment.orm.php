<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Comment\UndefinedComment;

return Entity::of(
    class: UndefinedComment::class,
)->withFields(
    Field::of(property: 'field'),
);
