<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;

final class EntityClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $entity = Entity::of(ProductVariant::class);

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame(ProductVariant::class, $resolvedEntity->class);
    }

    public function testNonExistingClass(): void
    {
        $entity = Entity::of('NonExistingClass');

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testEmptyClass(): void
    {
        $entity = Entity::of('');

        self::assertException(
            MappingException::emptyClassName(),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testAnonymousClass(): void
    {
        $object = new class {};

        $entity = Entity::of($object::class);

        self::assertException(
            MappingException::anonymousClass($object::class),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
