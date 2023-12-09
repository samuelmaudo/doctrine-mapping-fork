<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbedded;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedField;
use ReflectionClass;

/**
 * @internal
 */
final class PropertiesResolver
{
    /**
     * @param list<Field|Embedded> $properties
     *
     * @return array{list<ResolvedField|ResolvedEmbedded>, list<ResolvedEmbeddable>}
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        array $properties,
    ): array {
        $fields = [];
        $allEmbeddedEmbeddables = [];

        foreach ($properties as $property) {
            if ($property instanceof Field) {
                $fields[] = FieldResolver::resolve($class, $property);
            } elseif ($property instanceof Embedded) {
                [$embedded, $embeddedEmbeddables] = EmbeddedResolver::resolve($class, $property);
                $fields[] = $embedded;
                foreach ($embeddedEmbeddables as $embeddable) {
                    $allEmbeddedEmbeddables[] = $embeddable;
                }
            }
        }

        return [$fields, $allEmbeddedEmbeddables];
    }
}
