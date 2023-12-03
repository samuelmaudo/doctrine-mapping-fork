<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ResolvedElements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedId
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string $column
     * @param non-empty-string $type
     * @param ?positive-int $length
     */
    public function __construct(
        public string $property,
        public string $column,
        public string $type,
        public ?int $length = null,
        public ?bool $unsigned = null,
        public ?bool $fixed = null,
    ) {}
}
