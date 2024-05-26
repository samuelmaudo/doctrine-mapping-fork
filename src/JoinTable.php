<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @psalm-immutable
 */
final class JoinTable
{
    /**
     * @param non-empty-string $name
     */
    protected function __construct(
        protected string $name,
    ) {}

    /**
     * @param non-empty-string $name
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        ManyToMany $field,
        string $name,
    ): self {
        if ('' === $name) {
            throw MappingException::emptyJoinColumName($field->property());
        }

        return new self($name);
    }

    /**
     * @return non-empty-string
     */
    public function name(): string
    {
        return $this->name;
    }
}
