<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepository;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\ExistingRepositoryClass;

return MappedSuperclass::of(
    class: ExistingRepositoryClass::class,
    repositoryClass: ExistingRepository::class,
);
