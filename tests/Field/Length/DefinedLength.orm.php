<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Length\DefinedLength;

return Entity::of(
    class: DefinedLength::class,
)->withFields(
    Field::of(property: 'field', length: 5),
);
