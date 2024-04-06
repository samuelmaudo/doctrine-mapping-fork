<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedColumn
{
    /**
     * @param non-empty-string $name
     * @param ?non-empty-string $definition
     * @param ?positive-int $length
     * @param ?non-negative-int $precision
     * @param ?non-negative-int $scale
     * @param ?non-empty-string $charset
     * @param ?non-empty-string $collation
     * @param ?non-empty-string $comment
     */
    public function __construct(
        public string $name,
        public ?string $definition,
        public bool $unique,
        public bool $nullable,
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
