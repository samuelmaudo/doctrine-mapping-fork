<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepository;

return MappedSuperclass::of(
    class: ExistingRepositoryClass::class,
    repositoryClass: ExistingRepository::class,
);
