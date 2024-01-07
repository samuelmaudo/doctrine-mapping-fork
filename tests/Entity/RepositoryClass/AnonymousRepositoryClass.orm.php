<?php

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Entity\RepositoryClass\AnonymousRepositoryClass;

$object = new class {};

return Entity::of(
    class: AnonymousRepositoryClass::class,
    repositoryClass: $object::class,
);
