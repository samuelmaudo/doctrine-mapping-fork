<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embeddable;

$object = new class() {};

return Embeddable::of($object::class);
