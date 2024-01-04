<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Embeddable;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;

/**
 * @internal
 */
final class EmbeddableResolver
{
    /**
     * @return ResolvedEmbeddable[]
     * @throws MappingException
     */
    public static function resolve(Embeddable $embeddable): array
    {
        $class = ClassResolver::resolve($embeddable->class());
        [$fields, $embeddedEmbeddables] = PropertiesResolver::resolve($class, $embeddable->fields());

        return [new ResolvedEmbeddable($class->name, $fields), ...$embeddedEmbeddables];
    }
}
