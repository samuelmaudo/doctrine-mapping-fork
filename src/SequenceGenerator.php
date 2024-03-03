<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class SequenceGenerator
{
    private function __construct(
        private string $sequenceName,
        private int $allocationSize,
        private int $initialValue,
    ) {}

    /**
     * @param non-empty-string $sequenceName Name of the sequence.
     * @param positive-int $allocationSize
     * @param positive-int $initialValue Where the sequence starts.
     */
    public static function of(
        string $sequenceName,
        int $allocationSize = 1,
        int $initialValue = 1,
    ): self {
        return new self(
            $sequenceName,
            $allocationSize,
            $initialValue,
        );
    }

    public function sequenceName(): ?string
    {
        return $this->sequenceName;
    }

    public function allocationSize(): int
    {
        return $this->allocationSize;
    }

    public function initialValue(): int
    {
        return $this->initialValue;
    }
}
