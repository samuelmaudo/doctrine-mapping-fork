<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Embeddable
{
    /**
     * @param class-string $class
     * @param non-empty-list<Field|Embedded> $properties
     */
    private function __construct(
        private string $class,
        private array $properties,
    ) {}

    /**
     * @param class-string $class
     * @param non-empty-list<Field|Embedded> $properties
     */
    public static function of(
        string $class,
        array $properties,
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @return class-string
     */
    public function class(): string
    {
        return $this->class;
    }

    /**
     * @return non-empty-list<Field|Embedded>
     */
    public function properties(): array
    {
        return $this->properties;
    }
}
