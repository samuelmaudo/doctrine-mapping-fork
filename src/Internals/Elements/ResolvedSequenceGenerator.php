<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedSequenceGenerator
{
    /**
     * @param non-empty-string $sequenceName
     * @param positive-int $allocationSize
     * @param positive-int $initialValue
     */
    public function __construct(
        public string $sequenceName,
        public int $allocationSize,
        public int $initialValue,
    ) {}
}
