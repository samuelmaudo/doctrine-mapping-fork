<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\NonExistingRepositoryClass;

return MappedSuperclass::of(
    class: NonExistingRepositoryClass::class,
    repositoryClass: 'NonExistingRepository',
);
