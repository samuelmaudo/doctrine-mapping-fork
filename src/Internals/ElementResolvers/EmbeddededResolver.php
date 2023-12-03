<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Embeddeded;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddeded;
use ReflectionClass;

/**
 * @internal
 */
final class EmbeddededResolver
{
    /**
     * @param non-empty-string|false $parentColumnPrefix
     * @return array{ResolvedEmbeddeded, list<ResolvedEmbeddable>}
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        Embeddeded $embeddeded,
        string|bool $parentColumnPrefix = false,
    ): array {
        $property = PropertyResolver::resolve($class, $embeddeded->property());
        $class = PropertyClassResolver::resolve($property, $embeddeded->class());
        $columnPrefix = PropertyColumnPrefixResolver::resolve($property, $embeddeded->columnPrefix(), $parentColumnPrefix);

        $resolvedEmbeddeded = new ResolvedEmbeddeded(
            property: $property->name,
            class: $class->name,
            columnPrefix: $columnPrefix,
        );

        if (!$embeddeded->properties()) {
            return [$resolvedEmbeddeded, []];
        }

        [$fields, $embeddedEmbeddables] = PropertiesResolver::resolve($class, $embeddeded->properties());

        $resolvedEmbeddable = new ResolvedEmbeddable(
            class: $class->name,
            properties: $fields,
        );

        return [$resolvedEmbeddeded, [$resolvedEmbeddable, ...$embeddedEmbeddables]];
    }
}
