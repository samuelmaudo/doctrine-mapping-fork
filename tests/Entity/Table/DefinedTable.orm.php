<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\Table\DefinedTable;

return Entity::of(
    class: DefinedTable::class,
)->withTable(
    name: 'custom_table',
);
