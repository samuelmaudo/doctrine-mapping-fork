<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldColumnTest extends TestCase
{
    public function testDefinedColumnProperty(): void
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

    public function testUndefinedColumnProperty(): void
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
}
