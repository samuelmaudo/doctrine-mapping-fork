<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Generated\NeverGenerated;

return Entity::of(
    class: NeverGenerated::class,
)->withFields(
    Field::of(property: 'id', generated: Generated::Never),
    Field::of(property: 'field', generated: 'NEVER'),
);
