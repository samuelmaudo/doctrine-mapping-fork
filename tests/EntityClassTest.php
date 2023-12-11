<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;

final class EntityClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $entity = Entity::of(
            class: ProductVariant::class,
            properties: [],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame(ProductVariant::class, $resolvedEntity->class);
    }

    public function testNonExistingClass(): void
    {
        $entity = Entity::of(
            class: 'NonExistingClass',
            properties: [],
        );

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testEmptyClass(): void
    {
        $entity = Entity::of(
            class: '',
            properties: [],
        );

        self::assertException(
            MappingException::emptyClassName(),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testAnonymousClass(): void
    {
        $object = new class {};

        $entity = Entity::of(
            class: $object::class,
            properties: [],
        );

        self::assertException(
            MappingException::anonymousClass($object::class),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
