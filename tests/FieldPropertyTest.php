<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldPropertyTest extends TestCase
{
    public function testExistingProperty(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of('id'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id', $resolvedEntity->fields[0]->property);
    }

    public function testNonExistingProperty(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of('nonExistingProperty'),
        );

        self::assertException(
            MappingException::propertyNotFound(Product::class, 'nonExistingProperty'),
            fn () => EntityResolver::resolve($entity),
        );
    }

    public function testEmptyProperty(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(''),
        );

        self::assertException(
            MappingException::emptyPropertyName(Product::class),
            fn () => EntityResolver::resolve($entity),
        );
    }
}
