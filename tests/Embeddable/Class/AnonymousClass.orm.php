<?php

use Hereldar\DoctrineMapping\Embeddable;

$object = new class {};

return Embeddable::of($object::class);
