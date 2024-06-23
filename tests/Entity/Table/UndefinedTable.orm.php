<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\Table\UndefinedTable;

return Entity::of(
    class: UndefinedTable::class,
);
