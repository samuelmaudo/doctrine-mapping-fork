<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\ExistingRepositoryClass;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\ExistingRepository;

return Entity::of(
    class: ExistingRepositoryClass::class,
    repositoryClass: ExistingRepository::class,
);
