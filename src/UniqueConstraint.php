<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @psalm-immutable
 */
final class UniqueConstraint
{
    /**
     * @param non-empty-list<non-empty-string>|null $fields
     * @param non-empty-list<non-empty-string>|null $columns
     * @param ?non-empty-string $name
     * @param ?non-empty-array<non-empty-string,mixed> $options
     */
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
     * 
     * @throws DoctrineMappingException
     */
    public static function of(
        array|string|null $fields = null,
        array|string|null $columns = null,
        ?string $name = null,
        ?array $options = null
    ): self {
        if ('' === $name) {
            $name = null;
        }

        $fields = self::sanitizeFields($fields, $name);
        $columns = self::sanitizeColumns($columns, $name);
        $options = self::sanitizeOptions($options, $name);

        if (($fields && $columns) || (!$fields && !$columns)) {
            throw MappingException::invalidUniqueConstraintConfiguration($name);
        }

        return new self(
            $fields,
            $columns,
            $name,
            $options,
        );
    }

    /**
     * @return non-empty-list<non-empty-string>|null
     */
    public function fields(): ?array
    {
        return $this->fields;
    }

    /**
     * @return non-empty-list<non-empty-string>|null
     */
    public function columns(): ?array
    {
        return $this->columns;
    }

    /**
     * @return ?non-empty-string
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return ?non-empty-array<non-empty-string,mixed>
     */
    public function options(): ?array
    {
        return $this->options;
    }

    /**
     * @param non-empty-list<non-empty-string>|null $fields
     * @param ?non-empty-string $constraintName
     *
     * @return non-empty-list<non-empty-string>|null
     *
     * @throws DoctrineMappingException
     */
    private static function sanitizeFields(
        array|string|null $fields,
        ?string $constraintName,
    ): ?array {
        if (!$fields) {
            return null;
        }

        if (is_string($fields)) {
            return [$fields];
        }

        $validFields = [];

        foreach ($fields as $field) {
            if (is_string($field) && $field !== '') {
                $validFields[] = $field;
            } else {
                throw MappingException::invalidUniqueConstraintField(
                    $constraintName,
                    $field,
                );
            }
        }

        return $validFields;
    }

    /**
     * @param non-empty-list<non-empty-string>|null $columns
     * @param ?non-empty-string $constraintName
     *
     * @return non-empty-list<non-empty-string>|null
     *
     * @throws DoctrineMappingException
     */
    private static function sanitizeColumns(
        array|string|null $columns,
        ?string $constraintName,
    ): ?array {
        if (!$columns) {
            return null;
        }

        if (is_string($columns)) {
            return [$columns];
        }

        $validColumns = [];

        foreach ($columns as $column) {
            if (is_string($column) && $column !== '') {
                $validColumns[] = $column;
            } else {
                throw MappingException::invalidUniqueConstraintColumn(
                    $constraintName,
                    $column,
                );
            }
        }

        return $validColumns;
    }

    /**
     * @param ?non-empty-array<non-empty-string,mixed> $options
     * @param ?non-empty-string $constraintName
     *
     * @return ?non-empty-array<non-empty-string,mixed>
     *
     * @throws DoctrineMappingException
     */
    private static function sanitizeOptions(
        ?array $options,
        ?string $constraintName,
    ): ?array {
        if (!$options) {
            return null;
        }

        $validOptions = [];

        foreach ($options as $key => $value) {
            if (is_string($key) && $key !== '') {
                $validOptions[$key] = $value;
            } else {
                throw MappingException::invalidUniqueConstraintOption(
                    $constraintName,
                    $key,
                );
            }
        }

        return $validOptions;
    }
}
