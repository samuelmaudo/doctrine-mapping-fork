<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedId;
use ReflectionClass;

/**
 * @internal
 */
final class IdResolver
{
    /**
     * @param non-empty-string|false $columnPrefix
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        Id $id,
        string|bool $columnPrefix = false,
    ): ResolvedId {
        $property = PropertyResolver::resolve($class, $id->property());

        return new ResolvedId(
            property: $id->property(),
            column: PropertyColumnResolver::resolve($property, $id->column(), $columnPrefix),
            type: PropertyTypeResolver::resolve($property, $id->type()),
            length: $id->length(),
            unsigned: $id->unsigned(),
            fixed: $id->fixed(),
        );
    }
}
