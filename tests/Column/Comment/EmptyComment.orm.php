<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Comment\EmptyComment;

return Entity::of(
    class: EmptyComment::class,
)->withFields(
    Field::of(property: 'field')->withColumn(comment: ''),
);
