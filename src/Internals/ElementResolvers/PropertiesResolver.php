<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Embeddeded;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddeded;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedField;
use ReflectionClass;

/**
 * @internal
 */
final class PropertiesResolver
{
    /**
     * @param list<Field|Embeddeded> $properties
     * @param non-empty-string|false $columnPrefix
     *
     * @return array{list<ResolvedField|ResolvedEmbeddeded>, list<ResolvedEmbeddable>}
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        array $properties,
        string|bool $columnPrefix = false,
    ): array {
        $fields = [];
        $allEmbeddedEmbeddables = [];

        foreach ($properties as $property) {
            if ($property instanceof Field) {
                $fields[] = FieldResolver::resolve($class, $property, $columnPrefix);
            } elseif ($property instanceof Embeddeded) {
                [$embedded, $embeddedEmbeddables] = EmbeddededResolver::resolve($class, $property, $columnPrefix);
                $fields[] = $embedded;
                foreach ($embeddedEmbeddables as $embeddable) {
                    $allEmbeddedEmbeddables[] = $embeddable;
                }
            }
        }

        return [$fields, $allEmbeddedEmbeddables];
    }
}
