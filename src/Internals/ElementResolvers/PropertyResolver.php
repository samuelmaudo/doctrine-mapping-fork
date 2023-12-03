<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ElementResolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyResolver
{
    /**
     * @param non-empty-string $propertyName
     *
     * @throws MappingException
     */
    public static function resolve(
        ReflectionClass $class,
        string $propertyName,
    ): ReflectionProperty {
        if (!$propertyName) {
            throw MappingException::emptyPropertyName($class->name);
        }

        try {
            $property = $class->getProperty($propertyName);
        } catch (ReflectionException) {
            throw MappingException::propertyNotFound($class->name, $propertyName);
        }

        $property->setAccessible(true);

        return $property;
    }
}
