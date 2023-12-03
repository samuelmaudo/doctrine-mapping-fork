<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\ResolvedElements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedEmbeddeded
{
    /**
     * @param non-empty-string $property
     * @param class-string $class
     * @param non-empty-string|false $columnPrefix
     */
    public function __construct(
        public string $property,
        public string $class,
        public string|bool $columnPrefix,
    ) {}
}
