<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Entity
{
    private function __construct(
        private string $class,
        private array $properties,
        private ?string $table = null,
    ) {}

    /**
     * @param class-string $class
     * @param non-empty-list<Field|Embedded> $properties
     * @param ?non-empty-string $table
     */
    public static function of(
        string $class,
        array $properties,
        ?string $table = null,
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

    public function table(): ?string
    {
        return $this->table;
    }
}
