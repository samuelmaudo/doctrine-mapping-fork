<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class UniqueConstraint
{
    private function __construct(
        private ?array $fields,
        private ?array $columns,
        private ?string $name,
        private ?array $options,
    ) {}

    /**
     * @param non-empty-list<non-empty-string>|non-empty-string|null $fields
     * @param non-empty-list<non-empty-string>|non-empty-string|null $columns
     * @param ?non-empty-string $name Name of the unique constraint.
     * @param ?non-empty-array<non-empty-string,mixed> $options Platform specific options.
     */
    public static function of(
        array|string|null $fields = null,
        array|string|null $columns = null,
        ?string $name = null,
        ?array $options = null
    ): self {
        return new self(
            (is_string($fields)) ? [$fields] : $fields,
            (is_string($columns)) ? [$columns] : $columns,
            $name,
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

    public function options(): ?array
    {
        return $this->options;
    }
}
