<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedField
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string $column
     * @param ?non-empty-string $type
     * @param ?positive-int $length
     * @param ?non-negative-int $precision
     * @param ?non-negative-int $scale
     */
    public function __construct(
        public string $property,
        public string $column,
        public ?string $type,
        public bool $primaryKey = false,
        public bool $unique = false,
        public bool $nullable = false,
        public bool $insertable = true,
        public bool $updatable = true,
        public ?int $length = null,
        public ?int $precision = null,
        public ?int $scale = null,
        public ?bool $unsigned = null,
        public ?bool $fixed = null,
    ) {}
}
