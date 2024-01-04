<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\EmbeddableResolver;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;

final class EmbeddableClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $embeddable = Embeddable::of(ProductVariant::class);

        [$resolvedEmbeddable] = EmbeddableResolver::resolve($embeddable);

        self::assertSame(ProductVariant::class, $resolvedEmbeddable->class);
    }

    public function testNonExistingClass(): void
    {
        $embeddable = Embeddable::of('NonExistingClass');

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => EmbeddableResolver::resolve($embeddable),
        );
    }

    public function testEmptyClass(): void
    {
        $embeddable = Embeddable::of('');

        self::assertException(
            MappingException::emptyClassName(),
            fn () => EmbeddableResolver::resolve($embeddable),
        );
    }

    public function testAnonymousClass(): void
    {
        $object = new class {};

        $embeddable = Embeddable::of($object::class);

        self::assertException(
            MappingException::anonymousClass($object::class),
            fn () => EmbeddableResolver::resolve($embeddable),
        );
    }
}
