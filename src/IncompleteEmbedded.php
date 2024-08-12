<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;

final class IncompleteEmbedded extends AbstractEmbedded
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|false|null $columnPrefix
     * @param list<FieldLike> $fields
     *
     * @internal
     */
    public function __construct(
        protected readonly string $property,
        protected readonly string|bool|null $columnPrefix,
        protected readonly array $fields,
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

    public function withFields(
        FieldLike ...$fields,
    ): self {
        return new self(
            $this->property,
            $this->columnPrefix,
            \array_values($fields),
        );
    }
}
