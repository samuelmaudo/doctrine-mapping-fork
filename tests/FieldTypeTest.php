<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldTypeTest extends TestCase
{
    public function testDefinedType(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', type: 'integer'),
            Field::of(property: 'name', type: 'string'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('integer', $resolvedEntity->fields[0]->type);
        self::assertSame('string', $resolvedEntity->fields[1]->type);
    }

    public function testUndefinedType(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id'),
            Field::of(property: 'name'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->type);
        self::assertNull($resolvedEntity->fields[1]->type);
    }

    public function testEmptyType(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', type: ''),
            Field::of(property: 'name', type: ''),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->type);
        self::assertNull($resolvedEntity->fields[1]->type);
    }
}
