<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\EntityResolver;
use Hereldar\DoctrineMapping\Tests\Entities\User;

final class EmbeddedColumnPrefixTest extends TestCase
{
    public function testDefinedColumnPrefixProperty(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', columnPrefix: 'id_prefix_', properties: [
                    Field::of(property: 'value', column: 'id'),
                ]),
                Embedded::of(property: 'email', columnPrefix: 'email_prefix_', properties: [
                    Field::of(property: 'value', column: 'email'),
                ]),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id_prefix_', $resolvedEntity->properties[0]->columnPrefix);
        self::assertSame('email_prefix_', $resolvedEntity->properties[1]->columnPrefix);
    }

    public function testUndefinedColumnPrefixProperty(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', properties: [
                    Field::of(property: 'value'),
                ]),
                Embedded::of(property: 'email', properties: [
                    Field::of(property: 'value'),
                ]),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id_', $resolvedEntity->properties[0]->columnPrefix);
        self::assertSame('email_', $resolvedEntity->properties[1]->columnPrefix);
    }

    public function testFalseColumnPrefixProperty(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', columnPrefix: false, properties: [
                    Field::of(property: 'value', column: 'id'),
                ]),
                Embedded::of(property: 'email', columnPrefix: false, properties: [
                    Field::of(property: 'value', column: 'email'),
                ]),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertFalse($resolvedEntity->properties[0]->columnPrefix);
        self::assertFalse($resolvedEntity->properties[1]->columnPrefix);
    }
}
