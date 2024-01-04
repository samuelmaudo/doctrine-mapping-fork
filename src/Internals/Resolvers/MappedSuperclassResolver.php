<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedMappedSuperclass;
use Hereldar\DoctrineMapping\Internals\Validators\RepositoryClassValidator;
use Hereldar\DoctrineMapping\MappedSuperclass;

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
    public static function resolve(MappedSuperclass $superclass): array
    {
        $class = ClassResolver::resolve($superclass->class());
        RepositoryClassValidator::validate($superclass->repositoryClass());
        [$fields, $embeddedEmbeddables] = PropertiesResolver::resolve($class, $superclass->fields());

        $resolvedSuperclass = new ResolvedMappedSuperclass(
            $class->name,
            $superclass->repositoryClass(),
            $fields,
        );

        return [$resolvedSuperclass, $embeddedEmbeddables];
    }
}
