<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\InvalidRepositoryClass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\InvalidRepository;

return MappedSuperclass::of(
    class: InvalidRepositoryClass::class,
    repositoryClass: InvalidRepository::class,
);
