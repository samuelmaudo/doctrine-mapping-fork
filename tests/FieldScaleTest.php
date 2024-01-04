<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldScaleTest extends TestCase
{
    public function testDefinedScale(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'price', scale: 10),
        );

        [$entity] = EntityResolver::resolve($entity);

        self::assertSame(10, $entity->fields[0]->scale);
    }

    public function testUndefinedScale(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'price'),
        );

        [$entity] = EntityResolver::resolve($entity);

        self::assertNull($entity->fields[0]->scale);
    }

    public function testZeroScale(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'price', scale: 0),
        );

        self::assertException(
            MappingException::nonPositiveScale(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testNegativeScale(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'price', scale: -5),
        );

        self::assertException(
            MappingException::nonPositiveScale(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
