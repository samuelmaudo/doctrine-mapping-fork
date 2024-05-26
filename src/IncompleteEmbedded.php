<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\ClassResolver;

/**
 * @psalm-immutable
 */
final class IncompleteEmbedded implements FieldLike
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|false $columnPrefix
     * @param list<FieldLike> $fields
     *
     * @internal
     */
    public function __construct(
        private string $property,
        private string|bool $columnPrefix,
        private array $fields,
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

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return non-empty-string|false
     */
    public function columnPrefix(): string|bool
    {
        return $this->columnPrefix;
    }

    /**
     * @return list<FieldLike>
     */
    public function fields(): array
    {
        return $this->fields;
    }
}
