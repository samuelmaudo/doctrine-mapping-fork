<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Embeddeded;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddeded;
use ReflectionClass;
use ReflectionNamedType;
use voku\helper\ASCII;

/**
 * @internal
 */
final class EmbeddededResolver
{
    /**
     * @param non-empty-string|false $columnPrefix
     * @return array{ResolvedEmbeddeded, list<ResolvedEmbeddable>}
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        Embeddeded $embeddeded,
        string|bool $columnPrefix = false,
    ): array {
        $property = PropertyResolver::resolve($class, $embeddeded->property());

        if ($embeddeded->class()) {
            $embeddededClass = ClassResolver::resolve($embeddeded->class());
        } else {
            $propertyType = $property->getType();

            if (!$propertyType instanceof ReflectionNamedType) {
                throw MappingException::propertyTypeNotFound(
                    $property->class,
                    $property->name,
                );
            }

            $embeddededClass = ClassResolver::resolve($propertyType->getName());
        }

        $columnPrefix = $embeddeded->columnPrefix();

        if (!$embeddeded->columnPrefix()) {
            $columnPrefix = ASCII::to_slugify($property->name, separator: '_').'_';
        }

        $resolvedEmbeddeded = new ResolvedEmbeddeded(
            property: $property->name,
            class: $embeddededClass->name,
            columnPrefix: $columnPrefix,
        );

        return [$resolvedEmbeddeded, []];
    }
}
