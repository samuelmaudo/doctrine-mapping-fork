<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Order;
use Hereldar\DoctrineMapping\Tests\Entities\Product;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;
use Hereldar\DoctrineMapping\Tests\Entities\User;
use Hereldar\DoctrineMapping\Tests\Entities\UserEmail;
use Hereldar\DoctrineMapping\Tests\Entities\UserId;

final class EmbeddedClassTest extends TestCase
{
    public function testExistingClass(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', class: Product::class),
                Embedded::of(property: 'email', class: ProductVariant::class),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame(Product::class, $resolvedEntity->properties[0]->class);
        self::assertSame(ProductVariant::class, $resolvedEntity->properties[1]->class);
    }

    public function testNonExistingClass(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', class: 'NonExistingClass'),
                Embedded::of(property: 'email', class: 'NonExistingClass'),
            ],
        );

        self::assertException(
            MappingException::classNotFound('NonExistingClass'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testUndefinedClass(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id'),
                Embedded::of(property: 'email'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame(UserId::class, $resolvedEntity->properties[0]->class);
        self::assertSame(UserEmail::class, $resolvedEntity->properties[1]->class);
    }

    public function testEmptyClass(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', class: ''),
                Embedded::of(property: 'email', class: ''),
            ],
        );

        self::assertException(
            MappingException::emptyClassName(),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testMissingClass(): void
    {
        $entity = Entity::of(
            class: Order::class,
            properties: [
                Embedded::of(property: 'id'),
            ],
        );

        self::assertException(
            MappingException::missingClassAttribute(Order::class, 'id'),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
