<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;
use Hereldar\DoctrineMapping\Tests\Repositories\InvalidRepository;
use Hereldar\DoctrineMapping\Tests\Repositories\ValidRepository;

final class EntityRepositoryClassTest extends TestCase
{
    public function testUndefinedRepositoryClass(): void
    {
        $superclass = Entity::of(
            class: ProductVariant::class,
        );

        [$resolvedSuperclass] = EntityResolver::resolve($superclass);

        self::assertNull($resolvedSuperclass->repositoryClass);
    }

    public function testExistingRepositoryClass(): void
    {
        $superclass = Entity::of(
            class: ProductVariant::class,
            repositoryClass: ValidRepository::class,
        );

        [$resolvedSuperclass] = EntityResolver::resolve($superclass);

        self::assertSame(ValidRepository::class, $resolvedSuperclass->repositoryClass);
    }

    public function testNonExistingRepositoryClass(): void
    {
        $superclass = Entity::of(
            class: ProductVariant::class,
            repositoryClass: 'NonExistingClass',
        );

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => EntityResolver::resolve($superclass),
        );
    }

    public function testEmptyRepositoryClass(): void
    {
        $superclass = Entity::of(
            class: ProductVariant::class,
            repositoryClass: '',
        );

        self::assertException(
            MappingException::emptyClassName(),
            fn () => EntityResolver::resolve($superclass),
        );
    }

    public function testAnonymousRepositoryClass(): void
    {
        $object = new class {};

        $superclass = Entity::of(
            class: ProductVariant::class,
            repositoryClass: $object::class,
        );

        self::assertException(
            MappingException::anonymousClass($object::class),
            fn () => EntityResolver::resolve($superclass),
        );
    }

    public function testInvalidRepositoryClass(): void
    {
        $superclass = Entity::of(
            class: ProductVariant::class,
            repositoryClass: InvalidRepository::class,
        );

        self::assertException(
            MappingException::invalidRepositoryClass(InvalidRepository::class),
            fn () => EntityResolver::resolve($superclass),
        );
    }
}
