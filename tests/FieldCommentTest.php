<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\Product;

final class FieldCommentTest extends TestCase
{
    public function testDefinedComment(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', comment: 'integer'),
            Field::of(property: 'name', comment: 'string'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('integer', $resolvedEntity->fields[0]->comment);
        self::assertSame('string', $resolvedEntity->fields[1]->comment);
    }

    public function testUndefinedComment(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id'),
            Field::of(property: 'name'),
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertNull($resolvedEntity->fields[0]->comment);
        self::assertNull($resolvedEntity->fields[1]->comment);
    }

    public function testEmptyComment(): void
    {
        $entity = Entity::of(
            class: Product::class,
        )->withFields(
            Field::of(property: 'id', comment: ''),
        );

        $this->expectException(MappingException::emptyComment(Product::class, 'id'));

        EntityResolver::resolve($entity);
    }
}
