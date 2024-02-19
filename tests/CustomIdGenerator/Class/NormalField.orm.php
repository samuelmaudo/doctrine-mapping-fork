<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\ExistingIdGenerator;
use Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class\NormalField;

return Entity::of(
    class: NormalField::class,
)->withFields(
    Field::of(property: 'field')->withCustomIdGenerator(class: ExistingIdGenerator::class),
);
