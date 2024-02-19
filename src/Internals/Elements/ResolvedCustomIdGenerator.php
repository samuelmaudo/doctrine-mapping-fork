<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Elements;

/**
 * @internal
 * @psalm-immutable
 */
final class ResolvedCustomIdGenerator
{
    /**
     * @param ?class-string $class
     */
    public function __construct(
        public ?string $class,
    ) {}
}
