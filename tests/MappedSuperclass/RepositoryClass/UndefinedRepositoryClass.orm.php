<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\UndefinedRepositoryClass;

return MappedSuperclass::of(
    class: UndefinedRepositoryClass::class,
);
