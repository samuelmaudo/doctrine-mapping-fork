<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Embedded;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbedded;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedField;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;

/**
 * @internal
 */
final class FieldsResolver
{
    /**
     * @param list<Field|Embedded> $fields
     *
     * @return array{list<ResolvedField|ResolvedEmbedded>, list<ResolvedEmbeddable>}
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        array $fields,
    ): array {
        $resolvedFields = [];
        $allEmbeddedEmbeddables = [];

        foreach ($fields as $property) {
            if ($property instanceof Field) {
                $resolvedFields[] = FieldResolver::resolve($class, $property);
            } elseif ($property instanceof Embedded) {
                [$embedded, $embeddedEmbeddables] = EmbeddedResolver::resolve($class, $property);
                $resolvedFields[] = $embedded;
                foreach ($embeddedEmbeddables as $embeddable) {
                    $allEmbeddedEmbeddables[] = $embeddable;
                }
            }
        }

        return [$resolvedFields, $allEmbeddedEmbeddables];
    }
}
