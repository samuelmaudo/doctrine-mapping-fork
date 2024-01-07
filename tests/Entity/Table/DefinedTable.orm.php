<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\Table\DefinedTable;

return Entity::of(
    class: DefinedTable::class,
    table: 'custom_table',
);
