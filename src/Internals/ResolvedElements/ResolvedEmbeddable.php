<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ResolvedElements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedEmbeddable
{
    /**
     * @param class-string $class
     * @param list<ResolvedField|ResolvedEmbeddeded> $properties
     */
    public function __construct(
        public string $class,
        public array $properties,
    ) {}
}
