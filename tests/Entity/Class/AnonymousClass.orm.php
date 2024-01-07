<?php

use Hereldar\DoctrineMapping\Entity;

$object = new class {};

return Entity::of($object::class);
