<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Comment\DefinedComment;

return Entity::of(
    class: DefinedComment::class,
)->withFields(
    Field::of(property: 'field')->withColumn(comment: 'custom comment'),
);
