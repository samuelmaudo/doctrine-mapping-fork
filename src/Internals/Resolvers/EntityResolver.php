<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEntity;
use Hereldar\DoctrineMapping\Internals\Validators\RepositoryClassValidator;

/**
 * @internal
 */
final class EntityResolver
{
    /**
     * @throws MappingException
     *
     * @return array{ResolvedEntity, list<ResolvedEmbeddable>}
     */
    public static function resolve(Entity $entity): array
    {
        $class = ClassResolver::resolve($entity->class());
        RepositoryClassValidator::validate($entity->repositoryClass());
        $table = ClassTableResolver::resolve($class, $entity->table());
        [$fields, $embeddedEmbeddables] = PropertiesResolver::resolve($class, $entity->fields());

        $resolvedEntity = new ResolvedEntity(
            $class->name,
            $entity->repositoryClass(),
            $table,
            $fields,
        );

        return [$resolvedEntity, $embeddedEmbeddables];
    }
}
