<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\InvalidRepository;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\InvalidRepositoryClass;

return Entity::of(
    class: InvalidRepositoryClass::class,
    repositoryClass: InvalidRepository::class,
);
