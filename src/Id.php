<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Id
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     * @param ?non-empty-string $type
     * @param ?positive-int $length
     */
    private function __construct(
        private string $property,
        private ?string $column = null,
        private ?string $type = null,
        private ?int $length = null,
        private ?bool $unsigned = null,
        private ?bool $fixed = null,
    ) {}

    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     * @param ?non-empty-string $type
     * @param ?positive-int $length
     */
    public static function of(
        string $property,
        ?string $column = null,
        ?string $type = null,
        ?int $length = null,
        ?bool $unsigned = null,
        ?bool $fixed = null,
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return ?non-empty-string
     */
    public function column(): ?string
    {
        return $this->column;
    }

    /**
     * @return ?non-empty-string
     */
    public function type(): ?string
    {
        return $this->type;
    }

    /**
     * @return ?positive-int
     */
    public function length(): ?int
    {
        return $this->length;
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
