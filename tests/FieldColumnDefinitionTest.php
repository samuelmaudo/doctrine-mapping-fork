<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldColumnDefinitionTest extends TestCase
{
    public function testDefinedColumnDefinition(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', columnDefinition: 'integer'),
            Field::of(property: 'name', columnDefinition: 'string'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('integer', $resolvedEntity->fields[0]->columnDefinition);
        self::assertSame('string', $resolvedEntity->fields[1]->columnDefinition);
    }

    public function testUndefinedColumnDefinition(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id'),
            Field::of(property: 'name'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->columnDefinition);
        self::assertNull($resolvedEntity->fields[1]->columnDefinition);
    }

    public function testEmptyColumnDefinition(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', columnDefinition: ''),
        );

        self::assertException(
            MappingException::emptyColumnDefinition(Product::class, 'id'),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
