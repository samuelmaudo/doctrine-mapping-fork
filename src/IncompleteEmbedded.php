<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;

/**
 * @psalm-immutable
 */
final class IncompleteEmbedded extends AbstractEmbedded
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|false $columnPrefix
     * @param list<FieldLike> $fields
     *
     * @internal
     */
    public function __construct(
        protected string $property,
        protected string|bool $columnPrefix,
        protected array $fields,
    ) {}

    /**
     * @param class-string $class
     *
     * @throws DoctrineMappingException
     */
    public function withClass(string $class): Embedded
    {
        return new Embedded(
            $this->property,
            ClassResolver::resolve($class),
            $this->columnPrefix,
            $this->fields,
        );
    }

    /**
     * @param non-empty-list<FieldLike> $fields
     */
    public function withFields(
        FieldLike ...$fields,
    ): self {
        return new self(
            $this->property,
            $this->columnPrefix,
            $fields,
        );
    }
}
