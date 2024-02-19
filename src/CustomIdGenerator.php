<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class CustomIdGenerator
{
    private function __construct(
        private ?string $class,
    ) {}

    /**
     * @param ?class-string $class
     */
    public static function of(
        ?string $class = null,
    ): self {
        return new self($class);
    }

    public function class(): ?string
    {
        return $this->class;
    }
}
