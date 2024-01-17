<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldCollationTest extends TestCase
{
    public function testDefinedCollation(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', collation: 'integer'),
            Field::of(property: 'name', collation: 'string'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('integer', $resolvedEntity->fields[0]->collation);
        self::assertSame('string', $resolvedEntity->fields[1]->collation);
    }

    public function testUndefinedCollation(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id'),
            Field::of(property: 'name'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->collation);
        self::assertNull($resolvedEntity->fields[1]->collation);
    }

    public function testEmptyCollation(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', collation: ''),
        );

        $this->expectException(MappingException::emptyCollation(Product::class, 'id'));

        EntityResolver::resolve($entity);
    }
}
