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
     * @phpstan-return ReflectionClass<object>
     *
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
            /** @psalm-suppress ArgumentTypeCoercion */
            /** @phpstan-ignore argument.type */
            $class = new ReflectionClass($className);
        } catch (ReflectionException) {
            throw MappingException::classNotFound($className);
        }

        if ($class->isAnonymous()) {
            throw MappingException::anonymousClass($className);
        }

        return $class;
    }

    /**
     * @psalm-return ($className is null ? null : ReflectionClass)
     * @phpstan-return ($className is null ? null : ReflectionClass<object>)
     *
     * @throws DoctrineMappingException
     *
     * @psalm-assert class-string|null $className
     */
    public static function resolveNullable(?string $className): ?ReflectionClass
    {
        if (null === $className) {
            return null;
        }

        return self::resolve($className);
    }
}
