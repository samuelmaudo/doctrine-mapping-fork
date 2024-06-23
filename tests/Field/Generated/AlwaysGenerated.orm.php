<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Tests\Field\Generated\AlwaysGenerated;

return Entity::of(
    class: AlwaysGenerated::class,
)->withFields(
    Field::of(property: 'id', generated: Generated::Always),
    Field::of(property: 'field', generated: 'ALWAYS'),
);
