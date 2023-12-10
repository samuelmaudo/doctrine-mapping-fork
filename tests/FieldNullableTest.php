<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldNullableTest extends TestCase
{
    public function testDefinedNullable(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id', nullable: true),
                Field::of(property: 'categoryId', nullable: false),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertTrue($resolvedEntity->properties[0]->nullable);
        self::assertFalse($resolvedEntity->properties[1]->nullable);
    }

    public function testUndefinedNullable(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id'),
                Field::of(property: 'categoryId'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertFalse($resolvedEntity->properties[0]->nullable);
        self::assertTrue($resolvedEntity->properties[1]->nullable);
    }

    public function testNullablePrimaryKey(): void
    {
        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'id', primaryKey: true, nullable: true),
            ],
        );

        self::assertException(
            MappingException::nullablePrimaryKey(Product::class, 'id'),
            fn () => EntityResolver::resolve($entity),
        );

        $entity = Entity::of(
            class: Product::class,
            properties: [
                Field::of(property: 'categoryId', primaryKey: true),
            ],
        );

        self::assertException(
            MappingException::nullablePrimaryKey(Product::class, 'categoryId'),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
