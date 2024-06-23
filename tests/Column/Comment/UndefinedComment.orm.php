<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Column\Comment\UndefinedComment;

return Entity::of(
    class: UndefinedComment::class,
)->withFields(
    Field::of(property: 'field')->withColumn(),
);
