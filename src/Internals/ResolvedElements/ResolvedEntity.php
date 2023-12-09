<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ResolvedElements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedEntity
{
    /**
     * @param class-string $class
     * @param non-empty-string $table
     * @param list<ResolvedField|ResolvedEmbedded> $properties
     */
    public function __construct(
        public string $class,
        public string $table,
        public array $properties,
    ) {}
}
