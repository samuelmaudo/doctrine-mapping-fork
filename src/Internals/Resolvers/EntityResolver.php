<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEntity;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Validators\ClassOptionsResolver;
use Hereldar\DoctrineMapping\Internals\Validators\ClassSchemaResolver;
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
        ClassSchemaResolver::validate($class, $entity->schema());
        ClassOptionsResolver::validate($class, $entity->options());
        [$fields, $embeddedEmbeddables] = FieldsResolver::resolve($class, $entity->fields());
        $indexes = IndexesResolver::resolve($class, $entity->indexes());
        $uniqueConstraints = UniqueConstraintsResolver::resolve($class, $entity->uniqueConstraints());

        $resolvedEntity = new ResolvedEntity(
            $class->name,
            $entity->repositoryClass(),
            $table,
            $entity->schema(),
            $entity->options(),
            $fields,
            $indexes,
            $uniqueConstraints,
        );

        return [$resolvedEntity, $embeddedEmbeddables];
    }
}
