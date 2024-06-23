<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\ExistingRepository;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\ExistingRepositoryClass;

return Entity::of(
    class: ExistingRepositoryClass::class,
    repositoryClass: ExistingRepository::class,
);
