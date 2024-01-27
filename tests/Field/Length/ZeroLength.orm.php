<?php

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Length\ZeroLength;

return Entity::of(
    class: ZeroLength::class,
)->withFields(
    Field::of(property: 'field', length: 0),
);
