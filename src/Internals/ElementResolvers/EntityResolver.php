<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEmbeddable;
use Hereldar\DoctrineMapping\Internals\ResolvedElements\ResolvedEntity;

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
        $table = ClassTableResolver::resolve($class, $entity->table());
        [$fields, $embeddedEmbeddables] = PropertiesResolver::resolve($class, $entity->properties());

        return [new ResolvedEntity($class->name, $table, $fields), $embeddedEmbeddables];
    }
}
