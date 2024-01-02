<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\EntityRepository;

/**
 * @psalm-immutable
 */
final class MappedSuperclass
{
    private function __construct(
        private string $class,
        private array $properties,
        private ?string $repositoryClass = null,
    ) {}

    /**
     * @param class-string $class
     * @param non-empty-list<Field|Embedded> $properties
     * @param ?class-string<EntityRepository> $repositoryClass
     */
    public static function of(
        string $class,
        array $properties,
        ?string $repositoryClass = null,
    ): self {
        return new self(...func_get_args());
    }

    public function class(): string
    {
        return $this->class;
    }

    public function properties(): array
    {
        return $this->properties;
    }

    public function repositoryClass(): ?string
    {
        return $this->repositoryClass;
    }
}
