<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\NonExistingRepositoryClass;

return Entity::of(
    class: NonExistingRepositoryClass::class,
    repositoryClass: 'NonExistingRepository',
);
