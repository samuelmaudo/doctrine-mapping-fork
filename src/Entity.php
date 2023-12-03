<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Entity
{
    /**
     * @param class-string $class
     * @param non-empty-list<Field|Embeddeded> $properties
     * @param ?non-empty-string $table
     */
    private function __construct(
        private string $class,
        private array $properties,
        private ?string $table = null,
        private bool $insertable = true,
        private bool $updatable = true,
    ) {}

    /**
     * @param class-string $class
     * @param non-empty-list<Field|Embeddeded> $properties
     * @param ?non-empty-string $table
     */
    public static function of(
        string $class,
        array $properties,
        ?string $table = null,
        bool $insertable = true,
        bool $updatable = true,
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @return class-string
     */
    public function class(): string
    {
        return $this->class;
    }

    /**
     * @return non-empty-list<Field|Embeddeded>
     */
    public function properties(): array
    {
        return $this->properties;
    }

    /**
     * @return ?non-empty-string
     */
    public function table(): ?string
    {
        return $this->table;
    }

    public function insertable(): bool
    {
        return $this->insertable;
    }

    public function updatable(): bool
    {
        return $this->updatable;
    }
}
