<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbedded;
use ReflectionClass;

/**
 * @internal
 */
final class EmbeddedResolver
{
    /**
     * @return array{ResolvedEmbedded, list<ResolvedEmbeddable>}
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        Embedded $embedded,
    ): array {
        $property = PropertyResolver::resolve($class, $embedded->property());
        $class = PropertyClassResolver::resolve($property, $embedded->class());
        $columnPrefix = PropertyColumnPrefixResolver::resolve($property, $embedded->columnPrefix());

        $resolvedEmbedded = new ResolvedEmbedded(
            property: $property->name,
            class: $class->name,
            columnPrefix: $columnPrefix,
        );

        if (!$embedded->properties()) {
            return [$resolvedEmbedded, []];
        }

        [$fields, $embeddedEmbeddables] = PropertiesResolver::resolve($class, $embedded->properties());

        $resolvedEmbeddable = new ResolvedEmbeddable(
            class: $class->name,
            properties: $fields,
        );

        return [$resolvedEmbedded, [$resolvedEmbeddable, ...$embeddedEmbeddables]];
    }
}