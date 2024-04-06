<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;
use ReflectionException;

/**
 * @internal
 */
final class ClassResolver
{
    /**
     * @throws DoctrineMappingException
     *
     * @psalm-assert class-string $className
     */
    public static function resolve(string $className): ReflectionClass
    {
        if (!$className) {
            throw MappingException::emptyClassName();
        }

        try {
            $class = new ReflectionClass($className);
        } catch (ReflectionException) {
            throw MappingException::classNotFound($className);
        }

        if ($class->isAnonymous()) {
            throw MappingException::anonymousClass($className);
        }

        return $class;
    }
}
