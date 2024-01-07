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
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', precision: 10, scale: 5),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame(5, $resolvedEntity->fields[0]->scale);
    }

    public function testUndefinedScale(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', 'price', precision: 10),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->scale);
    }

    public function testZeroScale(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', precision: 10, scale: 0),
        );

        self::assertException(
            MappingException::nonPositiveScale(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testNegativeScale(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', precision: 10, scale: -5),
        );

        self::assertException(
            MappingException::nonPositiveScale(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testScaleGreaterThanPrecision(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', precision: 5, scale: 10),
        );

        self::assertException(
            MappingException::scaleGreaterThanPrecision(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
