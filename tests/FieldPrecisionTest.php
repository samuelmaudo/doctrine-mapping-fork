<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldPrecisionTest extends TestCase
{
    public function testDefinedPrecision(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', precision: 10),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame(10, $resolvedEntity->fields[0]->precision);
    }

    public function testUndefinedPrecision(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->precision);
    }

    public function testZeroPrecision(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', precision: 0),
        );

        self::assertException(
            MappingException::nonPositivePrecision(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testNegativePrecision(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', precision: -5),
        );

        self::assertException(
            MappingException::nonPositivePrecision(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testMissingPrecision(): void
    {
        $entity = Entity::of(Product::class)->withFields(
            Field::of('price', scale: 5),
        );

        self::assertException(
            MappingException::missingPrecision(Product::class, 'price'),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
