<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\InvalidRepository;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\InvalidRepositoryClass;

return MappedSuperclass::of(
    class: InvalidRepositoryClass::class,
    repositoryClass: InvalidRepository::class,
);
