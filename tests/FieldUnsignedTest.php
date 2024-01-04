<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldUnsignedTest extends TestCase
{
    public function testDefinedUnsigned(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', unsigned: true),
            Field::of(property: 'categoryId', unsigned: false),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertTrue($resolvedEntity->fields[0]->unsigned);
        self::assertFalse($resolvedEntity->fields[1]->unsigned);
    }

    public function testUndefinedUnsigned(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id'),
            Field::of(property: 'categoryId'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->unsigned);
        self::assertNull($resolvedEntity->fields[1]->unsigned);
    }
}
