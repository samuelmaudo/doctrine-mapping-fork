<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\Table\EmptyTable;

return Entity::of(
    class: EmptyTable::class,
)->withTable(
    name: '',
);
