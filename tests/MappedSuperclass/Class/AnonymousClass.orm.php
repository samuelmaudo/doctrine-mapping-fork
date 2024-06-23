<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;

$object = new class() {};

return MappedSuperclass::of($object::class);
