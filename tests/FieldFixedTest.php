<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Resolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\User;

final class FieldFixedTest extends TestCase
{
    public function testDefinedFixed(): void
    {
        $entity = Entity::of(
            class: User::class,
        )->withFields(
            Embedded::of(property: 'id')->withFields(
                Field::of(property: 'value', fixed: true),
            ),
            Embedded::of(property: 'email')->withFields(
                Field::of(property: 'value', fixed: false),
            ),
        );

        [, $embeddedEmbeddables] = EntityResolver::resolve($entity);

        self::assertTrue($embeddedEmbeddables[0]->fields[0]->fixed);
        self::assertFalse($embeddedEmbeddables[1]->fields[0]->fixed);
    }

    public function testUndefinedFixed(): void
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

        self::assertNull($embeddedEmbeddables[0]->fields[0]->fixed);
        self::assertNull($embeddedEmbeddables[1]->fields[0]->fixed);
    }
}
