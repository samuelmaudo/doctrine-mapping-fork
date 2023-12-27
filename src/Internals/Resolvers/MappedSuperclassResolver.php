<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\MappedSuperclass;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedMappedSuperclass;

/**
 * @internal
 */
final class MappedSuperclassResolver
{
    /**
     * @throws MappingException
     *
     * @return array{ResolvedMappedSuperclass, list<ResolvedEmbeddable>}
     */
    public static function resolve(MappedSuperclass $mappedSuperclass): array
    {
        $class = ClassResolver::resolve($mappedSuperclass->class());
        [$fields, $embeddedEmbeddables] = PropertiesResolver::resolve($class, $mappedSuperclass->properties());

        return [new ResolvedMappedSuperclass($class->name, $fields), $embeddedEmbeddables];
    }
}
