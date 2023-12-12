<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldUniqueTest extends TestCase
{
    public function testDefinedUnique(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id', unique: true),
                Field::of(property: 'categoryId', unique: false),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertTrue($resolvedEntity->properties[0]->unique);
        self::assertFalse($resolvedEntity->properties[1]->unique);
    }

    public function testUndefinedUnique(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id'),
                Field::of(property: 'categoryId'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertFalse($resolvedEntity->properties[0]->unique);
        self::assertFalse($resolvedEntity->properties[1]->unique);
    }
}
