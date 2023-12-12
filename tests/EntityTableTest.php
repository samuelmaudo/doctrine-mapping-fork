<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\ProductVariant;

final class EntityTableTest extends TestCase
{
    public function testDefinedTable(): void
    {
        $entity = Entity::of(
            class: ProductVariant::class,
            properties: [],
            table: 'product_variant_table',
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('product_variant_table', $resolvedEntity->table);
    }

    public function testUndefinedTable(): void
    {
        $entity = Entity::of(
            class: ProductVariant::class,
            properties: [],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('product_variant', $resolvedEntity->table);
    }

    public function testEmptyTable(): void
    {
        $entity = Entity::of(
            class: ProductVariant::class,
            properties: [],
            table: '',
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('product_variant', $resolvedEntity->table);
    }
}
