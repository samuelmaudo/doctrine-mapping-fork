<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\EntityResolver;
use Hereldar\DoctrineMapping\Internals\ElementResolvers\PropertyColumnPrefixResolver;
use Hereldar\DoctrineMapping\Tests\Entities\User;
use Hereldar\DoctrineMapping\Tests\Entities\UserId;
use ReflectionClass;
use TypeError;

final class EmbeddedColumnPrefixTest extends TestCase
{
    public function testDefinedColumnPrefix(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', columnPrefix: 'id_prefix_'),
                Embedded::of(property: 'email', columnPrefix: 'email_prefix_'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id_prefix_', $resolvedEntity->properties[0]->columnPrefix);
        self::assertSame('email_prefix_', $resolvedEntity->properties[1]->columnPrefix);
    }

    public function testUndefinedColumnPrefix(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id'),
                Embedded::of(property: 'email'),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id_', $resolvedEntity->properties[0]->columnPrefix);
        self::assertSame('email_', $resolvedEntity->properties[1]->columnPrefix);
    }

    public function testEmptyColumnPrefix(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', columnPrefix: ''),
                Embedded::of(property: 'email', columnPrefix: ''),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertSame('id_', $resolvedEntity->properties[0]->columnPrefix);
        self::assertSame('email_', $resolvedEntity->properties[1]->columnPrefix);
    }

    public function testFalseColumnPrefix(): void
    {
        $entity = Entity::of(
            class: User::class,
            properties: [
                Embedded::of(property: 'id', columnPrefix: false),
                Embedded::of(property: 'email', columnPrefix: false),
            ],
        );

        [$resolvedEntity] = EntityResolver::resolve($entity);

        self::assertFalse($resolvedEntity->properties[0]->columnPrefix);
        self::assertFalse($resolvedEntity->properties[1]->columnPrefix);
    }

    public function testTrueColumnPrefix(): void
    {
        self::assertException(
            TypeError::class,
            fn () => Embedded::of(property: 'id', columnPrefix: true),
        );

        $class = new ReflectionClass(User::class);
        $property = $class->getProperty('id');
        self::assertException(
            TypeError::class,
            fn () => PropertyColumnPrefixResolver::resolve($property, true),
        );

        self::assertException(
            TypeError::class,
            fn () => Embedded::of(property: 'id', class: UserId::class, columnPrefix: true),
        );
    }
}
