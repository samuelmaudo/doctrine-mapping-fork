<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Enums\Strategy;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedUniqueConstraint
{
    /**
     * @param ?non-empty-list<non-empty-string> $fields
     * @param ?non-empty-list<non-empty-string> $columns
     * @param ?non-empty-string $name
     * @param ?non-empty-array<non-empty-string,mixed> $options
     */
    public function __construct(
        public ?array $fields,
        public ?array $columns,
        public ?string $name,
        public ?array $options,
    ) {}
}
