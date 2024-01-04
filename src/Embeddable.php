<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Embeddable
{
    private function __construct(
        private string $class,
        private array $fields = [],
    ) {}

    /**
     * @param class-string $class
     */
    public static function of(
        string $class,
    ): self {
        return new self($class);
    }

    /**
     * @param non-empty-list<Field|Embedded> $fields
     */
    public function withFields(
        Field|Embedded ...$fields,
    ): self {
        return new self($this->class, $fields);
    }

    public function class(): string
    {
        return $this->class;
    }

    public function fields(): array
    {
        return $this->fields;
    }
}
