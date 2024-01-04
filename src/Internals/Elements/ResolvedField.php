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
        public bool $primaryKey,
        public bool $unique,
        public bool $nullable,
        public bool $insertable,
        public bool $updatable,
        public ?int $length,
        public ?int $precision,
        public ?int $scale,
        public ?bool $unsigned,
        public ?bool $fixed,
    ) {}
}
