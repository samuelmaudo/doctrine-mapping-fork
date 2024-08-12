<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;

/**
 * @internal
 */
final class CustomIdGeneratorResolver
{
    /**
     * @return ReflectionClass<AbstractIdGenerator>|null
     * @psalm-return ($className is null ? null : ReflectionClass<AbstractIdGenerator>)
     *
     * @throws DoctrineMappingException
     *
     * @psalm-assert class-string<AbstractIdGenerator>|null $className
     */
    public static function resolve(?string $className): ?ReflectionClass
    {
        if (null === $className) {
            return null;
        }

        $class = ClassResolver::resolve($className);

        if (!$class->isSubclassOf(AbstractIdGenerator::class)) {
            throw MappingException::invalidCustomIdGenerator($class->getShortName());
        }

        return $class;
    }
}
