<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\Class\ExistingClass;

return MappedSuperclass::of(ExistingClass::class);
