<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Field
{
    private function __construct(
        private string $property,
        private ?string $column = null,
        private ?string $type = null,
        private bool $primaryKey = false,
        private bool $unique = false,
        private ?bool $nullable = null,
        private bool $insertable = true,
        private bool $updatable = true,
        private ?int $length = null,
        private ?int $precision = null,
        private ?int $scale = null,
        private ?bool $unsigned = null,
        private ?bool $fixed = null,
    ) {}

    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     * @param ?non-empty-string $type
     * @param ?positive-int $length
     * @param ?non-negative-int $precision
     * @param ?non-negative-int $scale
     */
    public static function of(
        string $property,
        ?string $column = null,
        ?string $type = null,
        bool $primaryKey = false,
        bool $unique = false,
        ?bool $nullable = null,
        bool $insertable = true,
        bool $updatable = true,
        ?int $length = null,
        ?int $precision = null,
        ?int $scale = null,
        ?bool $unsigned = null,
        ?bool $fixed = null,
    ): self {
        return new self(...func_get_args());
    }

    public function property(): string
    {
        return $this->property;
    }

    public function column(): ?string
    {
        return $this->column;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function primaryKey(): bool
    {
        return $this->primaryKey;
    }

    public function unique(): bool
    {
        return $this->unique;
    }

    public function nullable(): ?bool
    {
        return $this->nullable;
    }

    public function insertable(): bool
    {
        return $this->insertable;
    }

    public function updatable(): bool
    {
        return $this->updatable;
    }

    public function length(): ?int
    {
        return $this->length;
    }

    public function precision(): ?int
    {
        return $this->precision;
    }

    public function scale(): ?int
    {
        return $this->scale;
    }

    public function unsigned(): ?bool
    {
        return $this->unsigned;
    }

    public function fixed(): ?bool
    {
        return $this->fixed;
    }
}
