<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Index
{
    private function __construct(
        private ?array $fields,
        private ?array $columns,
        private ?string $name,
        private ?array $flags,
        private ?array $options,
    ) {}

    /**
     * @param non-empty-list<non-empty-string>|non-empty-string|null $fields
     * @param non-empty-list<non-empty-string>|non-empty-string|null $columns
     * @param non-empty-string|null $name Name of the index.
     * @param non-empty-list<non-empty-string>|non-empty-string|null $flags
     * @param non-empty-array<non-empty-string,mixed>|null $options Platform specific options.
     */
    public static function of(
        array|string|null $fields = null,
        array|string|null $columns = null,
        string|null $name = null,
        array|string|null $flags = null,
        array|null $options = null,
    ): self {
        return new self(
            (is_string($fields)) ? [$fields] : $fields,
            (is_string($columns)) ? [$columns] : $columns,
            $name,
            (is_string($flags)) ? [$flags] : $flags,
            $options,
        );
    }

    public function fields(): ?array
    {
        return $this->fields;
    }

    public function columns(): ?array
    {
        return $this->columns;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function flags(): ?array
    {
        return $this->flags;
    }

    public function options(): ?array
    {
        return $this->options;
    }
}
