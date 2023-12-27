<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\MappedSuperclassResolver;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;

final class MappedSuperclassClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $mappedSuperclass = MappedSuperclass::of(
            class: ProductVariant::class,
            properties: [],
        );

        [$resolvedMappedSuperclass] = MappedSuperclassResolver::resolve($mappedSuperclass);

        self::assertSame(ProductVariant::class, $resolvedMappedSuperclass->class);
    }

    public function testNonExistingClass(): void
    {
        $mappedSuperclass = MappedSuperclass::of(
            class: 'NonExistingClass',
            properties: [],
        );

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => MappedSuperclassResolver::resolve($mappedSuperclass),
        );
    }

    public function testEmptyClass(): void
    {
        $mappedSuperclass = MappedSuperclass::of(
            class: '',
            properties: [],
        );

        self::assertException(
            MappingException::emptyClassName(),
            fn () => MappedSuperclassResolver::resolve($mappedSuperclass),
        );
    }

    public function testAnonymousClass(): void
    {
        $object = new class {};

        $mappedSuperclass = MappedSuperclass::of(
            class: $object::class,
            properties: [],
        );

        self::assertException(
            MappingException::anonymousClass($object::class),
            fn () => MappedSuperclassResolver::resolve($mappedSuperclass),
        );
    }
}
