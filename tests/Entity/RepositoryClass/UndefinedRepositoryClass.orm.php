<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\UndefinedRepositoryClass;

return Entity::of(
    class: UndefinedRepositoryClass::class,
);
