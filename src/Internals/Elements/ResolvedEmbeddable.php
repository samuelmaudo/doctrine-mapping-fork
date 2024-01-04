<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedEmbeddable
{
    /**
     * @param class-string $class
     * @param list<ResolvedField|ResolvedEmbedded> $fields
     */
    public function __construct(
        public string $class,
        public array $fields,
    ) {}
}
