<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Length\NegativeLength;

return Entity::of(
    class: NegativeLength::class,
)->withFields(
    Field::of(property: 'field', length: -5),
);
