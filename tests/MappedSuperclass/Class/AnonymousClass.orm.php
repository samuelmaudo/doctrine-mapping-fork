<?php

use Hereldar\DoctrineMapping\MappedSuperclass;

$object = new class {};

return MappedSuperclass::of($object::class);
