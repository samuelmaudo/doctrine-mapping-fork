<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Embeddeded;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Id;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddeded;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedField;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedId;
use ReflectionClass;

/**
 * @internal
 */
final class PropertiesResolver
{
    /**
     * @param list<Id|Field|Embeddeded> $properties
     * @param non-empty-string|false $columnPrefix
     *
     * @return array{list<ResolvedId|ResolvedField|ResolvedEmbeddeded>, list<ResolvedEmbeddable>}
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        array $properties,
        string|bool $columnPrefix = false,
    ): array {
        $fields = [];
        $allEmbeddables = [];

        foreach ($properties as $property) {
            if ($property instanceof Id) {
                $properties[] = IdResolver::resolve($class, $property, $columnPrefix);
            } elseif ($property instanceof Field) {
                $properties[] = FieldResolver::resolve($class, $property, $columnPrefix);
            } elseif ($property instanceof Embeddeded) {
                [$embedded, $embeddables] = EmbeddededResolver::resolve($class, $property, $columnPrefix);
                $properties[] = $embedded;
                foreach ($embeddables as $embeddable) {
                    $allEmbeddables[] = $embeddable;
                }
            }
        }

        return [$fields, $allEmbeddables];
    }
}
