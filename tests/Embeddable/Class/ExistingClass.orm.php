<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Tests\Embeddable\Class\ExistingClass;

return Embeddable::of(ExistingClass::class);
