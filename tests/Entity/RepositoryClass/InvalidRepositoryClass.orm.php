<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\InvalidRepositoryClass;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\InvalidRepository;

return Entity::of(
    class: InvalidRepositoryClass::class,
    repositoryClass: InvalidRepository::class,
);
