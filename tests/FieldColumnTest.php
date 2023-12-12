<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldColumnTest extends TestCase
{
    public function testDefinedColumn(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id', column: 'id_column'),
                Field::of(property: 'categoryId', column: 'category_id_column'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id_column', $resolvedEntity->properties[0]->column);
        self::assertSame('category_id_column', $resolvedEntity->properties[1]->column);
    }

    public function testUndefinedColumn(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id'),
                Field::of(property: 'categoryId'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id', $resolvedEntity->properties[0]->column);
        self::assertSame('category_id', $resolvedEntity->properties[1]->column);
    }

    public function testEmptyColumn(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id', column: ''),
                Field::of(property: 'categoryId', column: ''),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id', $resolvedEntity->properties[0]->column);
        self::assertSame('category_id', $resolvedEntity->properties[1]->column);
    }
}
