<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Internals\Elements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedMappedSuperclass;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Validators\ClassOptionsResolver;
use Hereldar\DoctrineMapping\Internals\Validators\ClassSchemaResolver;
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
        $table = ClassTableResolver::resolve($class, $superclass->table());
        ClassSchemaResolver::validate($class, $superclass->schema());
        ClassOptionsResolver::validate($class, $superclass->options());
        [$fields, $embeddedEmbeddables] = FieldsResolver::resolve($class, $superclass->fields());
        $indexes = IndexesResolver::resolve($class, $superclass->indexes());
        $uniqueConstraints = UniqueConstraintsResolver::resolve($class, $superclass->uniqueConstraints());

        $resolvedSuperclass = new ResolvedMappedSuperclass(
            $class->name,
            $superclass->repositoryClass(),
            $table,
            $superclass->schema(),
            $superclass->options(),
            $fields,
            $indexes,
            $uniqueConstraints,
        );

        return [$resolvedSuperclass, $embeddedEmbeddables];
    }
}
