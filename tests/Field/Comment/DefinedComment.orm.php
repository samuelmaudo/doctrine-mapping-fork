<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Comment\DefinedComment;

return Entity::of(
    class: DefinedComment::class,
)->withFields(
    Field::of(property: 'field', comment: 'custom comment'),
);
