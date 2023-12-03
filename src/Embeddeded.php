<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Embeddeded
{
    /**
     * @param non-empty-string $property
     * @param ?class-string $class
     * @param non-empty-string|false|null $columnPrefix
     * @param ?non-empty-list<Field|Embeddeded> $properties
     */
    private function __construct(
        private string $property,
        private ?string $class = null,
        private string|bool|null $columnPrefix = null,
        private ?array $properties = null,
    ) {}

    /**
     * @param ?class-string $class
     * @param non-empty-string|false|null $columnPrefix
     * @param ?non-empty-list<Field|Embeddeded> $properties
     */
    public static function of(
        string $property,
        ?string $class = null,
        string|bool|null $columnPrefix = null,
        ?array $properties = null,
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return ?class-string
     */
    public function class(): ?string
    {
        return $this->class;
    }

    /**
     * @return string|false|null
     */
    public function columnPrefix(): string|bool|null
    {
        return $this->columnPrefix;
    }

    /**
     * @return ?non-empty-list<Field|Embeddeded>
     */
    public function properties(): ?array
    {
        return $this->properties;
    }
}
