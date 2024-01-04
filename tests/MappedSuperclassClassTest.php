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
        $superclass = MappedSuperclass::of(ProductVariant::class);

        [$resolvedSuperclass] = MappedSuperclassResolver::resolve($superclass);

        self::assertSame(ProductVariant::class, $resolvedSuperclass->class);
    }

    public function testNonExistingClass(): void
    {
        $superclass = MappedSuperclass::of('NonExistingClass');

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => MappedSuperclassResolver::resolve($superclass),
        );
    }

    public function testEmptyClass(): void
    {
        $superclass = MappedSuperclass::of(class: '');

        self::assertException(
            MappingException::emptyClassName(),
            fn () => MappedSuperclassResolver::resolve($superclass),
        );
    }

    public function testAnonymousClass(): void
    {
        $object = new class {};

        $superclass = MappedSuperclass::of($object::class);

        self::assertException(
            MappingException::anonymousClass($object::class),
            fn () => MappedSuperclassResolver::resolve($superclass),
        );
    }
}
