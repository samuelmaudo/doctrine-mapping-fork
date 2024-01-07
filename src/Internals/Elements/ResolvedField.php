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
     * @param ?non-empty-string $columnDefinition
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     * @param 'NEVER'|'INSERT'|'ALWAYS'|null $generated
     * @param ?positive-int $length
     * @param ?non-negative-int $precision
     * @param ?non-negative-int $scale
     * @param ?non-empty-string $charset
     * @param ?non-empty-string $collation
     * @param ?non-empty-string $comment
     */
    public function __construct(
        public string $property,
        public string $column,
        public ?string $columnDefinition,
        public ?string $type,
        public ?string $enumType,
        public bool $primaryKey,
        public bool $unique,
        public bool $nullable,
        public bool $insertable,
        public bool $updatable,
        public ?string $generated,
        public ?int $length,
        public ?int $precision,
        public ?int $scale,
        public mixed $default,
        public ?bool $unsigned,
        public ?bool $fixed,
        public ?string $charset,
        public ?string $collation,
        public ?string $comment,
    ) {}
}
