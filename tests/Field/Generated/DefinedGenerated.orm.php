<?php

use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Field\Generated\DefinedGenerated;

return Entity::of(
    class: DefinedGenerated::class,
)->withFields(
    Field::of(property: 'never', generated: Generated::Never),
    Field::of(property: 'insert', generated: Generated::Insert),
    Field::of(property: 'always', generated: Generated::Always),
    Field::of(property: 'null', generated: null),
);
