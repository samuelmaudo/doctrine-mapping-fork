<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyClassResolver
{
    /**
     * @throws MappingException
     */
    public static function resolve(
        ReflectionProperty $property,
        ?string $className = null,
    ): ReflectionClass {
        if ($className) {
            return ClassResolver::resolve($className);
        }

        $propertyType = $property->getType();

        if (!$propertyType instanceof ReflectionNamedType) {
            throw MappingException::propertyTypeNotFound(
                $property->class,
                $property->name,
            );
        }

        return ClassResolver::resolve($propertyType->getName());
    }
}
