<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldUpdatableTest extends TestCase
{
    public function testDefinedUpdatable(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id', updatable: true),
                Field::of(property: 'categoryId', updatable: false),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertTrue($resolvedEntity->properties[0]->updatable);
        self::assertFalse($resolvedEntity->properties[1]->updatable);
    }

    public function testUndefinedUpdatable(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id'),
                Field::of(property: 'categoryId'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertTrue($resolvedEntity->properties[0]->updatable);
        self::assertTrue($resolvedEntity->properties[1]->updatable);
    }
}
