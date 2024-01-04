<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\MappedSuperclassResolver;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;
use Hereldar\DoctrineMapping\Tests\Repositories\InvalidRepository;
use Hereldar\DoctrineMapping\Tests\Repositories\ValidRepository;

final class MappedSuperclassRepositoryClassTest extends TestCase
{
    public function testUndefinedRepositoryClass(): void
    {
        $superclass = MappedSuperclass::of(
            class: ProductVariant::class,
        );

        [$resolvedSuperclass] = MappedSuperclassResolver::resolve($superclass);

        self::assertNull($resolvedSuperclass->repositoryClass);
    }

    public function testExistingRepositoryClass(): void
    {
        $superclass = MappedSuperclass::of(
            class: ProductVariant::class,
            repositoryClass: ValidRepository::class,
        );

        [$resolvedSuperclass] = MappedSuperclassResolver::resolve($superclass);

        self::assertSame(ValidRepository::class, $resolvedSuperclass->repositoryClass);
    }

    public function testNonExistingRepositoryClass(): void
    {
        $superclass = MappedSuperclass::of(
            class: ProductVariant::class,
            repositoryClass: 'NonExistingClass',
        );

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => MappedSuperclassResolver::resolve($superclass),
        );
    }

    public function testEmptyRepositoryClass(): void
    {
        $superclass = MappedSuperclass::of(
            class: ProductVariant::class,
            repositoryClass: '',
        );

        self::assertException(
            MappingException::emptyClassName(),
            fn () => MappedSuperclassResolver::resolve($superclass),
        );
    }

    public function testAnonymousRepositoryClass(): void
    {
        $object = new class {};

        $superclass = MappedSuperclass::of(
            class: ProductVariant::class,
            repositoryClass: $object::class,
        );

        self::assertException(
            MappingException::anonymousClass($object::class),
            fn () => MappedSuperclassResolver::resolve($superclass),
        );
    }

    public function testInvalidRepositoryClass(): void
    {
        $superclass = MappedSuperclass::of(
            class: ProductVariant::class,
            repositoryClass: InvalidRepository::class,
        );

        self::assertException(
            MappingException::invalidRepositoryClass(InvalidRepository::class),
            fn () => MappedSuperclassResolver::resolve($superclass),
        );
    }
}
