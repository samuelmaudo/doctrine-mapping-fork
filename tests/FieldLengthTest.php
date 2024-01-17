<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\User;
use Hereldar\DoctrineMapping\Tests\Entities\UserId;

final class FieldLengthTest extends TestCase
{
    public function testDefinedLength(): void
    {
        $entity = Entity::of(
            class: User::class,
        )->withFields(
            Embedded::of(property: 'id')->withFields(
                Field::of(property: 'value', length: 36),
            ),
            Embedded::of(property: 'email')->withFields(
                Field::of(property: 'value', length: 100),
            ),
        );

        [, $embeddedEmbeddables] = EntityResolver::resolve($entity);

        self::assertSame(36, $embeddedEmbeddables[0]->fields[0]->length);
        self::assertSame(100, $embeddedEmbeddables[1]->fields[0]->length);
    }

    public function testUndefinedLength(): void
    {
        $entity = Entity::of(
            class: User::class,
        )->withFields(
            Embedded::of(property: 'id')->withFields(
                Field::of(property: 'value'),
            ),
            Embedded::of(property: 'email')->withFields(
                Field::of(property: 'value'),
            ),
        );

        [, $embeddedEmbeddables] = EntityResolver::resolve($entity);

        self::assertNull($embeddedEmbeddables[0]->fields[0]->length);
        self::assertNull($embeddedEmbeddables[1]->fields[0]->length);
    }

    public function testZeroLength(): void
    {
        $entity = Entity::of(
            class: User::class,
        )->withFields(
            Embedded::of(property: 'id')->withFields(
                Field::of(property: 'value', length: 0),
            ),
        );

        $this->expectException(MappingException::nonPositiveLength(UserId::class, 'value'));

        EntityResolver::resolve($entity);
    }

    public function testNegativeLength(): void
    {
        $entity = Entity::of(
            class: User::class,
        )->withFields(
            Embedded::of(property: 'id')->withFields(
                Field::of(property: 'value', length: -5),
            ),
        );

        $this->expectException(MappingException::nonPositiveLength(UserId::class, 'value'));

        EntityResolver::resolve($entity);
    }
}
