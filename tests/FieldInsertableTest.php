<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldInsertableTest extends TestCase
{
    public function testDefinedInsertable(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', insertable: true),
            Field::of(property: 'categoryId', insertable: false),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertTrue($resolvedEntity->fields[0]->insertable);
        self::assertFalse($resolvedEntity->fields[1]->insertable);
    }

    public function testUndefinedInsertable(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id'),
            Field::of(property: 'categoryId'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertTrue($resolvedEntity->fields[0]->insertable);
        self::assertTrue($resolvedEntity->fields[1]->insertable);
    }
}
