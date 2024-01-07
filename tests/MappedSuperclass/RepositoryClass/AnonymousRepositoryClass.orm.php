<?php

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Tests\MappedSuperclass\RepositoryClass\AnonymousRepositoryClass;

$object = new class {};

return MappedSuperclass::of(
    class: AnonymousRepositoryClass::class,
    repositoryClass: $object::class,
);
