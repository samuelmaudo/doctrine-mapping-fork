<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Comment\EmptyComment;

return Entity::of(
    class: EmptyComment::class,
)->withFields(
    Field::of(property: 'field', comment: ''),
);
