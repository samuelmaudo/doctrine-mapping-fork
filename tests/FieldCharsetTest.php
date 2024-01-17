<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldCharsetTest extends TestCase
{
    public function testDefinedCharset(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', charset: 'integer'),
            Field::of(property: 'name', charset: 'string'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('integer', $resolvedEntity->fields[0]->charset);
        self::assertSame('string', $resolvedEntity->fields[1]->charset);
    }

    public function testUndefinedCharset(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id'),
            Field::of(property: 'name'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->charset);
        self::assertNull($resolvedEntity->fields[1]->charset);
    }

    public function testEmptyCharset(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', charset: ''),
        );

        $this->expectException(MappingException::emptyCharset(Product::class, 'id'));

        EntityResolver::resolve($entity);
    }
}
