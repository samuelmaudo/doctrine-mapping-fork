<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Validators;

use Doctrine\ORM\EntityRepository;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;

/**
 * @internal
 */
final class RepositoryClassValidator
{
    /**
     * @throws MappingException
     * @psalm-assert ?class-string<EntityRepository> $className
     */
    public static function validate(?string $className): void
    {
        if ($className === null) {
            return;
        }

        $class = ClassResolver::resolve($className);

        if (!$class->isSubclassOf(EntityRepository::class)) {
            throw MappingException::invalidRepositoryClass($className);
        }
    }
}
