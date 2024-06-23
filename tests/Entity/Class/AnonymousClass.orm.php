<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;

$object = new class() {};

return Entity::of($object::class);
