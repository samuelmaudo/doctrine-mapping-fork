<?php

declare(strict_types=1);

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\EmptyRepositoryClass;

return Entity::of(
    class: EmptyRepositoryClass::class,
    repositoryClass: '',
);
